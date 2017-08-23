<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain;

use RiskMan\Domain\DomainObject;
use RiskMan\Model\Player as MP;

/**
 * Description of Event
 *
 * @author rolf
 */
class Player extends DomainObject
{
    /*
     * @var RiskMan\Model\Bet\Player
     */
    protected $mp;
    
    /*
     * constructor TODO: Annotations
     */
    public function __construct(
        MP $mp
    ) 
    {
        $this->mp = $mp;
        $this->setFields([
            'player_id',
            'name'
        ]);
    }
    
    //POST
    public function create($data)
    {
        $this->setModelsBookId([
            $this->mp
        ]);
        
        $id = $data->player_id;
        
        $problem2 = $this->validateFields($data);
        if($problem2){
            return $problem2;
        }
        
        $problem3 = $this->validateData($data);
        if($problem3){
            return $problem3;
        }
        
        $SqlArr = $this->toSqlArray($data);
        $ms = $this->mp->read($id);
        if ($ms){
            //update odd
            $this->ms->update($id, $SqlArr);
        } else {
            //create odd
            $this->ms->create($SqlArr);
        }
        $msnew = $this->mp->read($id);
        
        return [
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => "Player succesfully created or updated.",
            'data' => $this->returnArray($msnew)
        ];
    }
    
    
    
    private function validateData($data)
    {
        
        if(isset($data['player_data'])) {
            $data = $data['player_data'];
        }

        return false;
    }

    private function toSqlArray ($data, $other = false) 
    {   
        $arr = [];
        if ($data->player_id){
            $arr['player_id'] = $data->player_id;
        }
        if ($data->name){
            $arr['name'] = $data->name;
        }
        
        if (is_array($other)){
            $arr = array_merge($arr, $other);
        }
        return $arr;
    }
    
    private function returnArray($dp)
    {
        if($dp){
            $a = $dp;
            //delete private data
            if(isset($a['id'])) {
                unset($a['id']);
            }
            if(isset($a['book_id'])) {
                unset($a['book_id']);
            }
            return $a;
        }
        return false;
    }
    
}

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
    
    public function getPlayerId($data)
    {
        $id = null;
        if (isset($data->player_data['player_id'])) {
            $id = $data->player_data['player_id'];
        } else if(isset($data->player_id)) {
            $id = $data->player_id;
        }
        return $id;
    }
    
    //POST
    public function create($data, $bookId)
    {
        $this->setModelsBookId([
            $this->mp
        ], $bookId);
        $player_data = [];
        
        $id = $this->getPlayerId($data);
        $player_data['player_id'] = $id;
        
        if(isset($data->player_data)) {
            $player_data = array_merge($player_data, $data->player_data);
        }
        
        $problem2 = $this->validateFields($player_data);
        if($problem2){
            return $problem2;
        }
        
        $problem3 = $this->validateData($player_data);
        if($problem3){
            return $problem3;
        }
        
        //when we add additional fields this needs to change
        $SqlArr = $player_data;
        
        $ms = $this->mp->read($id);
        if ($ms){
            //update odd
            $this->mp->update($id, $SqlArr);
        } else {
            //create odd
            $this->mp->create($SqlArr);
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
        $problem = [
            'code' => 422,
            'type' => 'ValidationError',
            'title' => 'InvalidData',
            'details' => '',
            'data' => []
        ];
        
        
        //minimum requirement for player creation
        if(!isset($data['player_id'])) {
            $problem['details'] = 'Unable to create player, player_id missing.';
            return $problem;
        }
        
        //cannot be empty either
        if(empty($data['player_id'])) {
            $problem['details'] = 'Unable to create player, player_id is empty';
            return $problem;
        }
       
        return false;
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

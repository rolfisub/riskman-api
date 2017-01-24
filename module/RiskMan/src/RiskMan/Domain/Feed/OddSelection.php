<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use RiskMan\Domain\Feed\DomainFeedObject;
use RiskMan\Model\Feed\OddSelection as MOs;
use RiskMan\Model\Feed\Odd;




/**
 * Description of Event
 *
 * @author rolf
 */
class OddSelection extends DomainFeedObject
{
    /*
     * @var RiskMan\Model\Feed\OddSelection
     */
    protected $os;
    
    /*
     * @var RiskMan\Model\Feed\Odd
     */
    protected $o;

    /*
     * constructor TODO: Annotations
     */
    public function __construct(Odd $o, MOs $os) 
    {
        $this->os = $os;
        $this->o = $o;
    }
    
    //POST
    public function create($data)
    {
        $id = $data->odd_selection_id;
        $problem = $this->validateData($data);
        if($problem){
            return $problem;
        }
        $oddSqlArr = $this->toSqlArray($data);
        $o = $this->o->read($id);
        if ($o){
            //update odd
            $this->o->update($id, $oddSqlArr);
        } else {
            //create odd
            $this->o->create($oddSqlArr);
        }
        return [
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => "Odd succesfully created or updated.",
            'data' => $this->returnOddArray($data->odd_id, $oddSqlArr)
        ];
    }
    
    private function validateData($data)
    {
        $o = $this->o->read($data->odd_id);
        if(!$o){
            return [
                'code' => 404,
                'type' => 'Error',
                'title' => 'Odd Not Found',
                'details'=> "odd_id = " . $data->odd_id . " not found, unable to create odd_selection = " . $data->odd_selection_id ,
                'data' => (array)$data
                
            ];
        }
        return false;
    }
    
    private function returnOddArray($odd_id)
    {
        $o = $this->o->read($odd_id);
        $a = [];
        if($o){
            $a = $o;
            //delete private data
            if(isset($a['id'])) {
                unset($a['id']);
            }
            if(isset($a['book_id'])) {
                unset($a['book_id']);
            }
            
            //get before unset
            $o = $this->o->readInternalId($a['odd_id']);
            
            //unset odd
            if(isset($a['odd_id'])) {
                unset($a['odd_id']);
            }
            
            //add odd id  
            $a['odd_id'] = $e['odd_id']; 
            
            return $a;
        }
        return false;
    }
    
    
    private function toSqlArray ($data, $other = false) 
    {   
        $arr = [];
        if ($data->odd_selection_id){
            $arr['odd_selection_id'] = $data->odd_selection_id;
        }
        if ($data->odd_selection_name) {
            $arr['name'] = $data->odd_selection_name;
        }
        if ($data->odd_id){
            $o = $this->o->read($data->odd_id);
            if($o) {
                $arr['odd_id'] = $o['id'];
            }
        }
        if ($data->odd) {
            $arr['odd'] = $data->odd;
        }
        if ($data->points) {
            $arr['points'] = $data->points;
        }
        
        if (is_array($other)){
            $arr = array_merge($arr, $other);
        }
        return $arr;
    }
}

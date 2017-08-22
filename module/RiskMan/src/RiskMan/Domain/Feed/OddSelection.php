<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use RiskMan\Domain\Feed\DomainFeedObject;
use RiskMan\Model\Feed\Event;
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
     * @var RiskMan\Model\Feed\Event
     */
    protected $e;

    /*
     * constructor TODO: Annotations
     */
    public function __construct(Odd $o, MOs $os, Event $e) 
    {
        $this->os = $os;
        $this->o = $o;
        $this->e = $e;
        $this->setFields([
            'odd_selection_id',
            'odd_selection_name',
            'odd_id',
            'event_id',
            'points',
            'odd',
        ]);
    }
    
    //POST
    public function create($data)
    {
        $this->setModelsBookId([
            $this->os,
            $this->o,
            $this->e
        ]);
        
        $id = $data->odd_selection_id;
        $problem = $this->validateFields($data);
        if($problem){
            return $problem;
        }
        $problem2 = $this->validateData($data);
        if($problem2){
            return $problem2;
        }
        $o = $this->o->read($data->odd_id);
        $odd_id  = $o['id'];
        $e = $this->e->read($data->event_id);
        $event_id  = $e['id'];
        $oddSqlArr = $this->toSqlArray($data);
        $os = $this->os->read($id,['odd_id' => $odd_id, 'event_id' => $event_id]);
        if ($os){
            //update odd
            $this->os->update($id, $oddSqlArr);
        } else {
            //create odd
            $this->os->create($oddSqlArr);
        }
        return [
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => "Odd succesfully created or updated.",
            'data' => $this->returnOddArray($data->odd_selection_id, $oddSqlArr)
        ];
    }
    
    private function validateData($data)
    {
        $e = $this->e->read($data->event_id);
        if(!$e){
            return [
                'code' => 404,
                'type' => 'Error',
                'title' => 'Event Not Found',
                'details'=> "event_id = " . $data->event_id . " not found, unable to create odd_selection = " . $data->odd_selection_id ,
                'data' => (array)$data
            ];
        }
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
        $o = $this->os->read($odd_id);
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
            $e = $this->e->readInternalId($a['event_id']);
            
            //unset odd
            if(isset($a['odd_id'])) {
                unset($a['odd_id']);
            }
            
            //unset event
            if(isset($a['event_id'])) {
                unset($a['event_id']);
            }
            
            //add odd id  
            $a['odd_id'] = $o['odd_id']; 
            $a['event_id'] = $e['event_id']; 
            
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
        if ($data->event_id){
            $e = $this->e->read($data->event_id);
            if($e) {
                $arr['event_id'] = $e['id'];
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

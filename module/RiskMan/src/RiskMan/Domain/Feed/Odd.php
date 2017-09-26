<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use RiskMan\Domain\Feed\DomainFeedObject;
use RiskMan\Domain\DomainResponse;
use RiskMan\Model\Feed\Odd as MOdd;
use RiskMan\Model\Feed\Event;




/**
 * Description of Event
 *
 * @author rolf
 */
class Odd extends DomainFeedObject
{
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
    public function __construct(Event $e, MOdd $odd) 
    {
        $this->o = $odd;
        $this->e = $e;
        $this->setFields([
            'odd_id',
            'odd_name',
            'event_id',
            'datetime',
        ]);
    }
    
    //POST
    public function create($data)
    {
        $this->setModelsBookId([
            $this->o,
            $this->e
        ]);
        
        $id = $data->odd_id;
        $problem = $this->validateFields($data);
        if($problem){
            return $problem;
        }
        $problem2 = $this->validateData($data);
        if($problem2){
            return $problem2;
        }
        $e = $this->e->read($data->event_id);
        $event_id = $e['id'];
        $oddSqlArr = $this->toSqlArray($data);
        $o = $this->o->read($id,['event_id' => $event_id]);
        if ($o){
            //update odd
            $this->o->update($id, $oddSqlArr);
        } else {
            //create odd
            $this->o->create($oddSqlArr);
        }
        return new DomainResponse([
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => "Odd succesfully created or updated.",
            'data' => $this->returnOddArray($data->odd_id, $oddSqlArr)
        ]);
    }
    
    private function validateData($data)
    {
        $e = $this->e->read($data->event_id);
        if(!$e){
            return [
                'code' => 404,
                'type' => 'Error',
                'title' => 'Event Not Found',
                'details'=> "event_id = " . $data->event_id . " not found, unable to create odd = " . $data->odd_id ,
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
            $e = $this->e->readInternalId($a['event_id']);
            
            //unset event
            if(isset($a['event_id'])) {
                unset($a['event_id']);
            }
            
            //add event id  
            $a['event_id'] = $e['event_id']; 
            
            return $a;
        }
        return false;
    }
    
    
    private function toSqlArray ($data, $other = false) 
    {   
        $arr = [];
        if ($data->odd_id){
            $arr['odd_id'] = $data->odd_id;
        }
        if ($data->odd_name) {
            $arr['name'] = $data->odd_name;
        }
        if ($data->datetime) {
            $arr['datetime'] = date("Y-m-d g:i:s", strtotime($data->datetime));
        }
        if ($data->event_id) {
            $e = $this->e->read($data->event_id);
            if ($e){
                $arr['event_id'] = $e['id'];
            }
        }
        
        if (is_array($other)){
            $arr = array_merge($arr, $other);
        }
        return $arr;
    }
}

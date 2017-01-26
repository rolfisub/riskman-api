<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Bet;
use RiskMan\Model\Bet\Single as MS;

use RiskMan\Model\Feed\Event;
use RiskMan\Model\Feed\Odd;
use RiskMan\Model\Feed\OddSelection;





/**
 * Description of Event
 *
 * @author rolf
 */
class Single
{
    /*
     * @var RiskMan\Model\Bet\Single
     */
    protected $ms;
    
    /*
     * @var RiskMan\Model\Feed\Event
     */
    protected $e;
    
    /*
     * @var RiskMan\Model\Feed\Odd
     */
    protected $o;
    
    /*
     * @var RiskMan\Model\Feed\OddSelection
     */
    protected $os;

    /*
     * constructor TODO: Annotations
     */
    public function __construct(MS $ms, Event $e, Odd $o, OddSelection $os) 
    {
        $this->ms = $ms;
        $this->e = $e;
        $this->o = $o;
        $this->os = $os;
    }
    
    //POST
    public function create($data)
    {
        $id = $data->single_id;
        $problem = $this->validateData($data);
        if($problem){
            return $problem;
        }
        $SqlArr = $this->toSqlArray($data);
        $e = $this->e->read($data->event_id);
        $o = $this->o->read($data->odd_id, ['event_id' => $e['id']]);
        $os = $this->os->read($data->odd_selection_id, ['odd_id' => $o['id']]);
        $ms = $this->ms->read($id, [
            'event_id' => $e['id'],
            'odd_id' => $o['id'],
            'odd_selection_id' => $os['id'],
        ]);
        if ($ms){
            //update odd
            $this->ms->update($id, $SqlArr);
        } else {
            //create odd
            $this->ms->create($SqlArr);
        }
        return [
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => "Odd succesfully created or updated.",
            'data' => $this->returnOddArray($id, $SqlArr)
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
                'details'=> "event_id = " . $data->event_id . " not found, unable to create single = " . $data->single_id,
                'data' => (array)$data
                
            ];
        }
        $o = $this->o->read($data->odd_id, ['event_id' => $e['id']]);
        if(!$o){
            return [
                'code' => 404,
                'type' => 'Error',
                'title' => 'Odd Not Found',
                'details'=> "odd_id = " . $data->odd_id . " not found, unable to create create single = " . $data->single_id,
                'data' => (array)$data
                
            ];
        }
        $os = $this->os->read($data->odd_selection_id, ['odd_id' => $o['id']]);
        if(!$os){
            return [
                'code' => 404,
                'type' => 'Error',
                'title' => 'Odd Selection Not Found',
                'details'=> "odd_selection_id = " . $data->odd_selection_id . " not found, unable to create create single = " . $data->single_id,
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
            
            //unset odd
            if(isset($a['odd_id'])) {
                unset($a['odd_id']);
            }
            
            //add odd id  
            $a['odd_id'] = $o['odd_id']; 
            
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

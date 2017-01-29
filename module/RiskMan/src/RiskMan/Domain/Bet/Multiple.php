<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Bet;
use RiskMan\Model\Bet\Multiple as MM;
use RiskMan\Model\Bet\MultipleSelection as MS;

use RiskMan\Model\Feed\Event;
use RiskMan\Model\Feed\Odd;
use RiskMan\Model\Feed\OddSelection;





/**
 * Description of Event
 *
 * @author rolf
 */
class Multiple
{
    /*
     * @var RiskMan\Model\Bet\Multiple
     */
    protected $mm;
    
    /*
     * @var RiskMan\Model\Bet\MultipleSelection
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
    public function __construct(MM $mm, MS $ms, Event $e, Odd $o, OddSelection $os) 
    {
        $this->mm = $mm;
        $this->ms = $ms;
        $this->e = $e;
        $this->o = $o;
        $this->os = $os;
    }
    
    //POST
    public function create($data)
    {
        $id = $data->multiple_id;
        $problem = $this->validateData($data);
        die();
        if($problem){
            return $problem;
        }
        $objects = $this->getObjects($data);
        $SqlArr = $this->toSqlArray($data, null, $objects);
        $ms = $this->ms->read($id, [
            'event_id' => $objects['e']['id'],
            'odd_id' => $objects['o']['id'],
            'odd_selection_id' => $objects['os']['id'],
        ]);
        if ($ms){
            //update odd
            $this->ms->update($id, $SqlArr);
        } else {
            //create odd
            $this->ms->create($SqlArr);
        }
        $objectsnew = $this->getObjects($data);
        $msnew = $this->ms->read($id, [
            'event_id' => $objectsnew['e']['id'],
            'odd_id' => $objectsnew['o']['id'],
            'odd_selection_id' => $objectsnew['os']['id'],
        ]);
        
        return [
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => "Odd succesfully created or updated.",
            'data' => $this->returnOddArray($msnew, $objectsnew )
        ];
    }
    
    
    
    private function validateData($data)
    {
        //validate multiple inputs
        
        die('this is how far Im');
        
        //validate optional pick inputs
        
        
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
    
    private function getObjects($data) 
    {
        $e = $this->e->read($data->event_id);
        $o = $this->o->read($data->odd_id, ['event_id' => $e['id']]);
        $os = $this->os->read($data->odd_selection_id, ['odd_id' => $o['id']]);
        $objects = [
            'e' => $e,
            'o' => $o,
            'os' => $os
        ];
        return $objects;
    }

    private function toSqlArray ($data, $other = false, $objects = null) 
    {   
        $e = null;
        $o = null;
        $os = null;
        if($objects){
            $e = $objects['e'];
            $o = $objects['o'];
            $os = $objects['os'];
        } else {
            die('objects required for this operation');
        }
        $arr = [];
        if ($data->single_id){
            $arr['single_id'] = $data->single_id;
        }
        if ($data->event_id){
            $arr['event_id'] = $e['id'];
        }
        if ($data->odd_id){
            $arr['odd_id'] = $o['id'];
        }
        if ($data->odd_selection_id){
            $arr['odd_selection_id'] = $os['id'];
        }
        if ($data->odd) {
            $arr['odd'] = $data->odd;
        }
        if ($data->points) {
            $arr['points'] = $data->points;
        }
        if ($data->risk) {
            $arr['risk'] = $data->risk;
        }
        if ($data->win) {
            $arr['win'] = $data->win;
        }
        
        if (is_array($other)){
            $arr = array_merge($arr, $other);
        }
        return $arr;
    }
    
    private function returnOddArray($ms, $o)
    {
        if($ms){
            $a = $ms;
            //delete private data
            if(isset($a['id'])) {
                unset($a['id']);
            }
            if(isset($a['book_id'])) {
                unset($a['book_id']);
            }
            if(isset($a['event_id'])){
                unset($a['event_id']);
            }
            if(isset($a['odd_id'])){
                unset($a['odd_id']);
            }
            if(isset($a['odd_selection_id'])){
                unset($a['odd_selection_id']);
            }
            
            $a['event_id'] = $o['e']['event_id'];
            $a['event_name'] = $o['e']['name'];
            $a['odd_id'] = $o['o']['odd_id'];
            $a['odd_selection_id'] = $o['os']['odd_selection_id'];
            
            return $a;
        }
        return false;
    }
    
}

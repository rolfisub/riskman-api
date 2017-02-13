<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Bet;

use RiskMan\Domain\Bet\MultipleSelection as DMS;

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
     * @var RiskMan\Domain\Bet\MultipleSelection
     */
    protected $dms;
    
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
    public function __construct(MM $mm, MS $ms, DMS $dms, Event $e, Odd $o, OddSelection $os) 
    {
        $this->mm = $mm;
        $this->ms = $ms;
        $this->dms = $dms;
        $this->e = $e;
        $this->o = $o;
        $this->os = $os;
    }
    
    //POST
    public function create($data)
    {
        $id = $data->multiple_id;
        
        //check picks data
        $problem = $this->validateData($data);
        if($problem){
            return $problem;
        }
        
        //create multiple object
        $SqlArr = $this->toSqlArray($data, null, $objects);
        $ms = $this->mm->read($id);
        if ($ms){
            //update odd
            $this->mm->update($id, $SqlArr);
        } else {
            //create odd
            $this->mm->create($SqlArr);
        }
        $msnew = $this->mm->read($id);
        
        //create only if picks have been specified
        if(isset($data->picks)) {
            //create each multiple selection id
            foreach($data->picks as $key => $pick) {
                $pick['multiple_id'] = $id;
                $pickO = (object)$pick;
                $response = $this->dms->create($pickO);
                if($response['code'] != 200) {
                    return $response;
                }
            }
        }
        
        return [
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => "Multiple succesfully created or updated.",
            'data' => $this->returnOddArray($msnew)
        ];
    }
    
    
    
    private function validateData($data)
    {   
        //validate optional pick inputs
        foreach($data->picks as $key => $pick) {
            $e = $this->e->read($pick['event_id']);
            if(!$e){
                return [
                    'code' => 404,
                    'type' => 'Error',
                    'title' => 'Event Not Found',
                    'details'=> "event_id = " . $pick['event_id'] . " not found, unable to create multiple = " . $data->multiple_id,
                    'data' => (array)$data

                ];
            }
            $o = $this->o->read($pick['odd_id'], ['event_id' => $e['id']]);
            if(!$o){
                return [
                    'code' => 404,
                    'type' => 'Error',
                    'title' => 'Odd Not Found',
                    'details'=> "odd_id = " . $pick['odd_id'] . " not found, unable to create create multiple = " . $data->multiple_id,
                    'data' => (array)$data

                ];
            }
            $os = $this->os->read($pick['odd_selection_id'], ['odd_id' => $o['id'], 'event_id' => $e['id']]);
            if(!$os){
                return [
                    'code' => 404,
                    'type' => 'Error',
                    'title' => 'Odd Selection Not Found',
                    'details'=> "odd_selection_id = " . $pick['odd_selection_id'] . " not found, unable to create create multiple = " . $data->multiple_id,
                    'data' => (array)$data

                ];
            }
        }
        
        
        
        return false;
    }

    private function toSqlArray ($data, $other = false, $objects = null) 
    {   
        
        $arr = [];
        if ($data->multiple_id){
            $arr['multiple_id'] = $data->multiple_id;
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
    
    private function returnOddArray($ms)
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
            
            return $a;
        }
        return false;
    }
    
}

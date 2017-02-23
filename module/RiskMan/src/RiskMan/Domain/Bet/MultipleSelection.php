<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Bet;
use RiskMan\Domain\Bet\DomainBetObject;
use RiskMan\Model\Bet\MultipleSelection as MS;
use RiskMan\Model\Bet\Multiple as M;

use RiskMan\Model\Feed\Event;
use RiskMan\Model\Feed\Odd;
use RiskMan\Model\Feed\OddSelection;


use RiskMan\Domain\Feed\Event as DEvent;
use RiskMan\Domain\Feed\Odd as DOdd;
use RiskMan\Domain\Feed\OddSelection as DOSelection;

use Zend\ServiceManager\ServiceLocatorInterface as SM;


/**
 * Description of Event
 *
 * @author rolf
 */
class MultipleSelection extends DomainBetObject
{
    /*
     * @var RiskMan\Model\Bet\MultipleSelection
     */
    protected $ms;
    
    /*
     * @var RiskMan\Model\Bet\Multiple
     */
    protected $m;
    
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
    public function __construct(
        SM $sm,
        DEvent $de,
        DOdd $do,
        DOSelection $dos,
        MS $ms, 
        M $m, 
        Event $e, 
        Odd $o, 
        OddSelection $os
    ) 
    {
        parent::__construct($sm, $de, $do, $dos);   
        $this->ms = $ms;
        $this->m = $m;
        $this->e = $e;
        $this->o = $o;
        $this->os = $os;
        $this->setFields([
            'multiple_id',
            'multiple_selection_id',
            'event_id',
            'event_data',
            'odd_id',
            'odd_data',
            'odd_selection_id',
            'odd_selection_data',
            'odd',
            'points',
        ]);
    }
    
    //POST
    public function create($data)
    {
        $id = $data->multiple_selection_id;
        $problem = $this->validateFields($data);
        if($problem){
            return $problem;
        }
        $problem = $this->validateData($data);
        if($problem){
            return $problem;
        }
        $objects = $this->getObjects($data);
        $SqlArr = $this->toSqlArray($data, null, $objects);
        $ms = $this->ms->read($id, [
            'multiple_id' => $objects['m']['id'],
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
            'multiple_id' => $objects['m']['id'],
            'event_id' => $objectsnew['e']['id'],
            'odd_id' => $objectsnew['o']['id'],
            'odd_selection_id' => $objectsnew['os']['id'],
        ]);
        
        return [
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => "Bet succesfully created or updated.",
            'data' => $this->returnOddArray($msnew, $objectsnew )
        ];
    }
    
    
    
    private function validateData($data)
    {
        $m = $this->m->read($data->multiple_id);
        if(!$m){
            return [
                'code' => 404,
                'type' => 'Error',
                'title' => 'Event Not Found',
                'details'=> "multiple_id = " . $data->multiple_id . " not found, unable to create multiple_selection = " . $data->multiple_selection_id,
                'data' => (array)$data

            ];
        }
        $e = $this->e->read($data->event_id);
        if(!$e){
            return [
                'code' => 404,
                'type' => 'Error',
                'title' => 'Event Not Found',
                'details'=> "event_id = " . $data->event_id . " not found, unable to create multiple_selection = " . $data->multiple_selection_id,
                'data' => (array)$data

            ];
        }
        $o = $this->o->read($data->odd_id, ['event_id' => $e['id']]);
        if(!$o){
            return [
                'code' => 404,
                'type' => 'Error',
                'title' => 'Odd Not Found',
                'details'=> "odd_id = " . $data->odd_id . " not found, unable to create create multiple_selection = " . $data->multiple_selection_id,
                'data' => (array)$data

            ];
        }
        $os = $this->os->read($data->odd_selection_id, ['odd_id' => $o['id'], 'event_id' => $e['id']]);
        if(!$os){
            return [
                'code' => 404,
                'type' => 'Error',
                'title' => 'Odd Selection Not Found',
                'details'=> "odd_selection_id = " . $data->odd_selection_id . " not found, unable to create create multiple_selection = " . $data->multiple_selection_id,
                'data' => (array)$data

            ];
        }
        //need to check if any other pick already has the same pick
        $mres = $this->ms->checkForExistingPick($data->multiple_selection_id, $m['id'], $e['id'], $o['id'], $os['id']);
        if($mres) {
            return [
                'code' => 422,
                'type' => 'Error',
                'title' => 'Pick Already exists',
                'details'=> 'Existing multiple selection detected using different id. Abort.',
                'data' => (array)$data
            ];
        }
        return false;
    }
    
    private function getObjects($data) 
    {
        $m = $this->m->read($data->multiple_id);
        $e = $this->e->read($data->event_id);
        $o = $this->o->read($data->odd_id, ['event_id' => $e['id']]);
        $os = $this->os->read($data->odd_selection_id, ['odd_id' => $o['id'], 'event_id' => $e['id']]);
        $objects = [
            'm' => $m,
            'e' => $e,
            'o' => $o,
            'os' => $os
        ];
        return $objects;
    }

    private function toSqlArray ($data, $other = false, $objects = null) 
    {   
        $m = null;
        $e = null;
        $o = null;
        $os = null;
        if($objects){
            $m = $objects['m'];
            $e = $objects['e'];
            $o = $objects['o'];
            $os = $objects['os'];
        } else {
            die('objects required for this operation');
        }
        $arr = [];
        if ($data->multiple_selection_id){
            $arr['multiple_selection_id'] = $data->multiple_selection_id;
        }
        if ($data->multiple_id){
            $arr['multiple_id'] = $m['id'];
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
            if(isset($a['multiple_id'])){
                unset($a['multiple_id']);
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
            
            $a['multiple_id'] = $o['m']['multiple_id'];
            $a['event_id'] = $o['e']['event_id'];
            $a['event_name'] = $o['e']['name'];
            $a['odd_id'] = $o['o']['odd_id'];
            $a['odd_selection_id'] = $o['os']['odd_selection_id'];
            
            return $a;
        }
        return false;
    }
    
}

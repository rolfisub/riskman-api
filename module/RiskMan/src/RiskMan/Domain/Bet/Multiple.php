<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Bet;
use RiskMan\Domain\Bet\DomainBetObject;
        
use RiskMan\Domain\Bet\MultipleSelection as DMS;

use RiskMan\Model\Bet\Multiple as MM;
use RiskMan\Model\Bet\MultipleSelection as MS;


use RiskMan\Model\Feed\Event;
use RiskMan\Model\Feed\Odd;
use RiskMan\Model\Feed\OddSelection;
use RiskMan\Model\Player;

use RiskMan\Domain\Feed\Event as DEvent;
use RiskMan\Domain\Feed\Odd as DOdd;
use RiskMan\Domain\Feed\OddSelection as DOSelection;
use RiskMan\Domain\Player as DP;
use Zend\ServiceManager\ServiceLocatorInterface as SM;





/**
 * Description of Event
 *
 * @author rolf
 */
class Multiple extends DomainBetObject
{   
    /**
     * Multiple deps
     */
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
     * @var RiskMan\Model\Player
     */
    protected $p;

    /*
     * constructor TODO: Annotations
     */
    public function __construct(
        SM $sm,
        DEvent $de,
        DOdd $do,
        DOSelection $dos,
        DP $dp,
        MM $mm, 
        MS $ms, 
        DMS $dms, 
        Event $e, 
        Odd $o, 
        OddSelection $os,
        Player $p
    ) 
    {
        parent::__construct($sm, $de, $do, $dos, $dp);
        $this->mm = $mm;
        $this->ms = $ms;
        $this->dms = $dms;
        $this->e = $e;
        $this->o = $o;
        $this->os = $os;
        $this->p = $p;
        $this->setFields([
            'multiple_id',
            'risk',
            'win',
            'picks',
            'player_id',
            'player_data'
        ]);
    }
    
    //POST
    public function create($data)
    {
        $this->setModelsBookId([
            $this->mm,
            $this->ms,
            $this->dms,
            $this->e,
            $this->o,
            $this->os,
            $this->p
        ]);
        
        $id = $data->multiple_id;
        
        $problem4 = $this->createPlayerObject($data, $this->getBookId());
        if($problem4['code'] !== 200){
            return $problem4;
        }
        
        $problem = $this->validateFields($data);
        if($problem){
            return $problem;
        }
        
        //check picks data
        $problem2 = $this->validateData($data);
        if($problem2){
            return $problem2;
        }
        
        //create multiple object
        $objects = $this->getObjects($data);
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
                $problem = $this->createOtherFeedObjects($pick);
                if($problem){
                    return $problem;
                }
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
            'data' => $this->returnOddArray($msnew, $objects)
        ];
    }
    
     private function getObjects($data) 
    {
        $p = $this->p->read($this->dp->getPlayerId($data));
        $objects = [
            'p' => $p
        ];
        return $objects;
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
        $p = null;
        if($objects){
            $p = $objects['p'];
        } else {
            die('objects required for this operation');
        }
        
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
        if ($data->player_id || $data->player_data['player_id']) {
            $arr['player_id'] = $p['id'];
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
            if(isset($a['player_id'])){
                unset($a['player_id']);
            }
            
            $a['player_id'] = $o['p']['player_id'];
            
            return $a;
        }
        return false;
    }
    
}

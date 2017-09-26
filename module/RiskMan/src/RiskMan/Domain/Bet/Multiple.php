<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Bet;
use RiskMan\Domain\Bet\DomainBetObject;
use RiskMan\Domain\DomainResponse;
        
use RiskMan\Domain\Bet\MultipleSelection as DMS;

use RiskMan\Model\Bet\Multiple as MM;
use RiskMan\Model\Bet\MultipleSelection as MS;


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
     * constructor TODO: Annotations
     */
    public function __construct(
        SM $sm,
        DEvent $de,
        DOdd $do,
        DOSelection $dos,
        MM $mm, 
        MS $ms, 
        DMS $dms, 
        Event $e, 
        Odd $o, 
        OddSelection $os
    ) 
    {
        parent::__construct($sm, $de, $do, $dos);
        $this->mm = $mm;
        $this->ms = $ms;
        $this->dms = $dms;
        $this->e = $e;
        $this->o = $o;
        $this->os = $os;
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
            $this->os
        ]);
        
        $id = $data->multiple_id;
        
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
                if($response->code != 200) {
                    return $response;
                }
            }
        }
        
        return new DomainResponse([
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => "Multiple succesfully created or updated.",
            'data' => $this->returnOddArray($msnew)
        ]);
    }
    
    
    /**
     * 
     * @param type $data
     * @return boolean|DomainResponse
     */
    private function validateData($data)
    {   
        //validate optional pick inputs
        $problem = new DomainResponse([
            'code' => 404,
            'type' => 'Error'
        ]);
        foreach($data->picks as $key => $pick) {
            $e = $this->e->read($pick['event_id']);
            if(!$e){
                $problem->title = 'Event Not Found';
                $problem->details = 'event_id = ' . $pick['event_id'] . ' not found, unable to create multiple = ' . $data->multiple_id;
                $problem->data = (array)$data;
                return $problem;
            }
            $o = $this->o->read($pick['odd_id'], ['event_id' => $e['id']]);
            if(!$o){
                $problem->title = 'Odd Not Found';
                $problem->details = 'odd_id = ' . $pick['odd_id'] . ' not found, unable to create create multiple = ' . $data->multiple_id;
                $problem->data = (array)$data;
                return $problem;
            }
            $os = $this->os->read($pick['odd_selection_id'], ['odd_id' => $o['id'], 'event_id' => $e['id']]);
            if(!$os){
                $problem->title = 'Odd Selection Not Found';
                $problem->details = 'odd_selection_id = ' . $pick['odd_selection_id'] . ' not found, unable to create create multiple = ' . $data->multiple_id;
                $problem->data = (array)$data;
                return $problem;
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

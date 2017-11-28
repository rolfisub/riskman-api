<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Bet;
use RiskMan\Domain\Bet\DomainBetObject;
use RiskMan\Domain\DomainResponse;
use RiskMan\Model\Bet\Single as MS;

use RiskMan\Model\Feed\Event;
use RiskMan\Model\Feed\Odd;
use RiskMan\Model\Feed\OddSelection;

use RiskMan\Domain\Feed\Event as DEvent;
use RiskMan\Domain\Feed\Odd as DOdd;
use RiskMan\Domain\Feed\OddSelection as DOSelection;

use RiskMan\BookCurrency\BookCurrency;
use RiskMan\BookOptions\BookOptions;
use RiskMan\OddFormat\OddFormat;

use Zend\ServiceManager\ServiceLocatorInterface as SM;


/**
 * Description of Event
 *
 * @author rolf
 */
class Single extends DomainBetObject
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
    
    /**
     * @var BookCurrency
     */
    protected $bookCurrency;
    
    /**
     * @var BookOptions
     */
    protected $bookOptions;
    
    /**
     * @var OddFormat
     */
    protected $oddFormat;

    /*
     * constructor TODO: Annotations
     */
    public function __construct(
        SM $sm,
        DEvent $de,
        DOdd $do,
        DOSelection $dos,
        MS $ms, 
        Event $e, 
        Odd $o, 
        OddSelection $os,
        BookCurrency $bc,
        BookOptions $bo
    ) 
    {
        parent::__construct($sm, $de, $do, $dos);
        $this->ms = $ms;
        $this->e = $e;
        $this->o = $o;
        $this->os = $os;
        $this->bookCurrency = $bc;
        $this->bookOptions = $bo;
        $this->oddFormat = new OddFormat();
        $this->setFields([
            'single_id',
            'event_id',
            'event_data',
            'odd_id',
            'odd_data',
            'odd_selection_id',
            'odd_selection_data',
            'risk',
            'win',
            'odd',
            'points',
            'player_id',
            'player_data'
        ]);
    }
    
    //POST
    public function create($data)
    {
        $this->setModelsBookId([
            $this->ms,
            $this->e,
            $this->o,
            $this->os,
            $this->de,
            $this->do,
            $this->dos
        ]);
        
        $id = $data->single_id;
        $problem = $this->createOtherFeedObjects($data);
        if($problem){
            return $problem;
        }
        $problem2 = $this->validateFields($data);
        if($problem2){
            return $problem2;
        }
        
        $problem3 = $this->validateData($data);
        if($problem3){
            return $problem3;
        }
        
        /**
         * convert input odd to American format
         */
        $options = $this->bookOptions->getOptions($this->getBookId());
        $data->odd = $this->oddFormat->convertFromTo($options->odd_format, 'American', $data->odd);
        
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
        return new DomainResponse([
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => "Single succesfully created or updated.",
            'data' => $this->returnOddArray($msnew, $objectsnew )
        ]);
    }
    
    
    
    private function validateData($data)
    {
        $response = new DomainResponse([
            'code' => 404,
            'type' => 'Error'
        ]);
        $e = $this->e->read($data->event_id);
        if(!$e){
            $response->title = 'Event Not Found';
            $response->details = 'event_id = ' . $data->event_id . ' not found, unable to create single = ' . $data->single_id;
            $response->data = (array)$data;
            return $response;
        }
        $o = $this->o->read($data->odd_id, ['event_id' => $e['id']]);
        if(!$o){
            $response->title = 'Odd Not Found';
            $response->details = 'odd_id = ' . $data->odd_id . ' not found, unable to create create single = ' . $data->single_id;
            $response->data = (array)$data;
            return $response;
        }
        $os = $this->os->read($data->odd_selection_id, ['odd_id' => $o['id'], 'event_id' => $e['id']]);
        if(!$os){
            $response->title = 'Odd Selection Not Found';
            $response->details = 'odd_selection_id = ' . $data->odd_selection_id . ' not found, unable to create create single = ' . $data->single_id;
            $response->data = (array)$data;
            return $response;
        }
        return false;
    }
    
    private function getObjects($data) 
    {
        $e = $this->e->read($data->event_id);
        $o = $this->o->read($data->odd_id, ['event_id' => $e['id']]);
        $os = $this->os->read($data->odd_selection_id, ['odd_id' => $o['id'], 'event_id' => $e['id']]);
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
            
            //add currency field
            $a['risk_usd'] = $this->bookCurrency->convertToUSD($a['risk'], $this->getBookId());
            if(isset($a['win'])) {
                $a['win_usd'] = $this->bookCurrency->convertToUSD($a['win'], $this->getBookId());
            }
            
            /**
            * convert input odd to Original format
            */
            $options = $this->bookOptions->getOptions($this->getBookId());
            $a['odd'] = $this->oddFormat->convertFromTo('American', $options->odd_format, $a['odd']);
            
            return $a;
        }
        return false;
    }
    
}

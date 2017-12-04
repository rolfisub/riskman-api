<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use RiskMan\Domain\Feed\DomainFeedObject;
use RiskMan\Domain\DomainResponse;
use RiskMan\Model\Feed\Event;
use RiskMan\Model\Feed\OddSelection as MOs;
use RiskMan\Model\Feed\Odd;
use RiskMan\BookOptions\BookOptions;
use RiskMan\OddFormat\OddFormat;
use RiskMan\Suggestive\Suggestive;
use RiskMan\Suggestive\Entity\Feed\OddSelection as SuggestionOSEntity;


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
    
    /**
     * @var BookOptions
     */
    protected $bookOptions;
    
    /**
     * Odd converter
     * @var OddFormat
     */
    protected $oddConverter;
    
    /**
     * Suggestive service
     * @var Suggestive
     */
    protected $suggestive;

    /*
     * constructor TODO: Annotations
     */
    public function __construct(Odd $o, MOs $os, Event $e, BookOptions $bo, Suggestive $ss) 
    {
        $this->os = $os;
        $this->o = $o;
        $this->e = $e;
        $this->bookOptions = $bo;
        $this->oddConverter = new OddFormat();
        $this->suggestive = $ss;
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
        
        /**
         * convert input odd to American format
         */
        $options = $this->bookOptions->getOptions($this->getBookId());
        $data->odd = $this->oddConverter->convertFromTo($options->odd_format, 'American', $data->odd);
        
        
        
        //get needed objects
        $o = $this->o->read($data->odd_id);
        $odd_id  = $o['id'];
        $e = $this->e->read($data->event_id);
        $event_id  = $e['id'];
        
        /**
         * get odd suggestion from odd change
         */
        $SuggestionOSEntity = new SuggestionOSEntity();
        $SuggestionOSEntity->book_id = $this->getBookId();
        $SuggestionOSEntity->odd = $data->odd;
        $SuggestionOSEntity->odd_id = $odd_id;
        $SuggestionOSEntity->odd_selection_id = $data->odd_selection_id;
        $suggestion = $this->suggestive->getFeedSuggestion($SuggestionOSEntity);
        
        
        //check for update or insert
        $oddSqlArr = $this->toSqlArray($data);
        $os = $this->os->read($id,['odd_id' => $odd_id, 'event_id' => $event_id]);
        if ($os){
            //update odd
            //$this->os->updateByKey($os['id'], $oddSqlArr);
            $this->os->update($id, $oddSqlArr);
        } else {
            //create odd
            $this->os->create($oddSqlArr);
        }
        
        return new DomainResponse([
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => 'Odd succesfully created or updated.',
            'data' => $this->returnOddArray($data->odd_selection_id, $oddSqlArr)
        ]);
    }
    
    private function validateData($data)
    {
        $problem = new DomainResponse([
            'code' => 404,
            'type' => 'Error'
        ]);
        $e = $this->e->read($data->event_id);
        if(!$e){
            $problem->title = 'Event Not Found';
            $problem->details = 'event_id = ' . $data->event_id . ' not found, unable to create odd_selection = ' . $data->odd_selection_id;
            $problem->data = (array)$data;
            return $problem;
        }
        $o = $this->o->read($data->odd_id);
        if(!$o){
            $problem->title = 'Odd Not Found';
            $problem->details = 'odd_id = ' . $data->odd_id . ' not found, unable to create odd_selection = ' . $data->odd_selection_id;
            $problem->data = (array)$data;
            return $problem;
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
            
            //format odd back to origin format
            /**
            * convert input odd to Original format
            */
            $options = $this->bookOptions->getOptions($this->getBookId());
            $a['odd'] = $this->oddConverter->convertFromTo('American', $options->odd_format, $a['odd']);
            
            
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

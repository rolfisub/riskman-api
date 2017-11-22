<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use RiskMan\Domain\Feed\DomainFeedObject;
use RiskMan\Domain\DomainResponse;
use RiskMan\Model\Feed\Event as MEvent;
use RiskMan\Model\Feed\Sport;
use RiskMan\Model\Feed\League;
use RiskMan\Model\Feed\Region;
use RiskMan\BookOptions\BookOptions;



/**
 * Description of Event
 *
 * @author rolf
 */
class Event extends DomainFeedObject
{
    /*
     * @var RiskMan\Model\Feed\Event
     */
    protected $e;
    
    /*
     * @var RiskMan\Model\Sport
     */
    protected $s;
    
    /*
     * @var RiskMan\Model\League
     */
    protected $l;
    
    /*
     * @var RiskMan\Model\Region
     */
    protected $r;
    
    /**
     * @var BookOptions
     */
    protected $bookOptions;
    
    /*
     * constructor TODO: Annotations
     */
    public function __construct(MEvent $event, Sport $sport, League $league, Region $region, BookOptions $bo) 
    {
        $this->e = $event;
        $this->s = $sport;
        $this->l = $league;
        $this->r = $region;
        $this->bookOptions = $bo;
        $this->setFields([
            'event_id',
            'event_name',
            'sport_id',
            'sport_name',
            'region_id',
            'region_name',
            'league_id',
            'league_name',
            'datetime'
        ]);
    }
   
    //POST
    public function create($data)
    {
        $this->setModelsBookId([
            $this->e,
            $this->s,
            $this->l,
            $this->r
        ]);
        
        $id = $data->event_id;
        $problem = $this->validateFields($data);
        if($problem){
            return $problem;
        }
        $otherArr = $this->createOtherFeedObjects($data);
        $eventSqlArr = $this->toSqlArray($data, $otherArr);
        $e = $this->e->read($id);
        if ($e){
            //update event
            $this->e->update($id, $eventSqlArr);
        } else {
            //create event
            $this->e->create($eventSqlArr);
        }
        return new DomainResponse([
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => 'Event succesfully created or updated.',
            'data' => $this->returnEventArray($data->event_id,$eventSqlArr)
        ]);
    }
    
    private function returnEventArray($event_id, $event_arr)
    {
        $e = $this->e->read($event_id);
        $a = [];
        if($e){
            $a = $e;
            //delete private data
            if(isset($a['id'])) {
                unset($a['id']);
            }
            if(isset($a['sport_id'])) {
                unset($a['sport_id']);
            }
            if(isset($a['league_id'])) {
                unset($a['league_id']);
            }
            if(isset($a['region_id'])) {
                unset($a['region_id']);
            }
            if(isset($a['book_id'])) {
                unset($a['book_id']);
            }
            
            //add other data to array
            if (isset($event_arr['sport_id']) && $event_arr['sport_id'] != NULL ) {
                $s = $this->s->readInternalId($event_arr['sport_id']);
                $a['sport_id'] = $s['sport_id'];
                $a['sport_name'] = $s['name'];
            }
            if (isset($event_arr['league_id']) && $event_arr['league_id'] != NULL ) {
                $s = $this->l->readInternalId($event_arr['league_id']);
                $a['league_id'] = $s['league_id'];
                $a['league_name'] = $s['name'];
            }
            if (isset($event_arr['region_id']) && $event_arr['region_id'] != NULL ) {
                $s = $this->r->readInternalId($event_arr['region_id']);
                $a['region_id'] = $s['region_id'];
                $a['region_name'] = $s['name'];
            }
            
            return $a;
        }
        return false;
    }
    
    
    private function toSqlArray ($data, $other = false) 
    {   
        $arr = [];
        if ($data->event_id){
            $arr['event_id'] = $data->event_id;
        }
        if ($data->event_name) {
            $arr['name'] = $data->event_name;
        }
        if ($data->datetime) {
            $arr['datetime'] = date("Y-m-d g:i:s", strtotime($data->datetime));
        }
        if (is_array($other)){
            $arr = array_merge($arr, $other);
        }
        return $arr;
    }
    
    //process creation or update of other objects also returns array with relation Ids
    private function createOtherFeedObjects($data)
    {
        $arr = [];
        if ($data->sport_id){
            $sdata['sport_id'] = $data->sport_id;
            if($data->sport_name) {
                $sdata['name'] = $data->sport_name;
            }
            $s = $this->s->read($data->sport_id);
            if($s) {
                //save to main array the object id
                $arr['sport_id'] = $s['id'];
                //update object data
                $this->s->update($data->sport_id, $sdata);
            } else {
                //create a new object
                $arr['sport_id'] = $this->s->create($sdata);
            }
        }
        if ($data->league_id){
            $ldata['league_id'] = $data->league_id;
            if($data->league_name) {
                $ldata['name'] = $data->league_name;
            }
            $l = $this->l->read($data->league_id);
            if($l) {
                //save to main array the object id
                $arr['league_id'] = $l['id'];
                //update object data
                $this->l->update($data->league_id, $ldata);
            } else {
                //create a new object
                $arr['league_id'] = $this->l->create($ldata);
            }
            
        }
        if ($data->region_id){
            $rdata['region_id'] = $data->region_id;
            if($data->region_name) {
                $rdata['name'] = $data->region_name;
            }
            $r = $this->r->read($data->region_id);
            if($r) {
                //save to main array the object id
                $arr['region_id'] = $r['id'];
                //update object data
                $this->r->update($data->region_id, $rdata);
            } else {
                //create a new object
                $arr['region_id'] = $this->r->create($rdata);
            }
            
        }
        if(sizeof($arr) > 0){
            return $arr;
        }
        return false;
    }
    
   
    
    
}

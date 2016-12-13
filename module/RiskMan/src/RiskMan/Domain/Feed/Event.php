<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use RiskMan\Model\Feed\Event as MEvent;
use RiskMan\Domain\Feed\Sport;
use RiskMan\Domain\Feed\League;
use RiskMan\Domain\Feed\Region;


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
     * @var RiskMan\Domain\Sport
     */
    protected $sport;
    
    /*
     * @var RiskMan\Domain\League
     */
    protected $league;
    
    /*
     * @var RiskMan\Domain\Region
     */
    protected $region;
    
    /*
     * constructor TODO: Annotations
     */
    public function __construct(MEvent $event, Sport $sport, League $league, Region $region) 
    {
        $this->e = $event;
        $this->sport = $sport;
        $this->league = $league;
        $this->region = $region;
    }
    
    //POST
    public function create($data, $bookId)
    {
        
        $eventId = $data->event_id;
        $e = $this->e->getEvent($eventId, $bookId); 
        if (!$e) {
            //create new event
            echo "creating new event\n";
            $e = $this->e->newEvent($data, $bookId);
        } else {
            //event exist
            echo "existing event\n";
            //$e = $this->update($data, $bookId, $e);
        }
        return $e;
    }
    
    private function _createOtherObjects($data, $bookId, $e)
    {
        if ($data->sport_id){
            $s = $this->sport->create($data, $bookId);
            $e = $e->setSport($s);
        }
        if ($data->league_id){
            $l = $this->league->create($data, $bookId);
            $e = $e->setLeague($l);
        }
        if ($data->region_id){
            $r = $this->region->create($data, $bookId);
            $e = $e->setRegion($r);
        }
        return $e;
    }
    
    
}

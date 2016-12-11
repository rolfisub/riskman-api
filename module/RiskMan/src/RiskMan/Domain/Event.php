<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain;
use RiskMan\Domain\DomainObject;
use RiskMan\Entity\Feed\Event as EEvent;
use RiskMan\Domain\Sport;
use RiskMan\Domain\League;
use RiskMan\Domain\Region;


/**
 * Description of Event
 *
 * @author rolf
 */
class Event extends DomainObject
{
    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    /*
     * @var RiskMan\Entity\Feed\Event
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
    public function __construct(\Doctrine\ORM\EntityManager $em, Sport $sport, League $league, Region $region) 
    {
        parent::__construct($em);
        $this->em = $em;
        $this->sport = $sport;
        $this->league = $league;
        $this->region = $region;
    }
    
    //POST
    public function create($data, $bookId = 1)
    {
        $event_id = $data->event_id;
        $e = $this->_exists('Event', $bookId, 'event_id' ,$event_id);
        if (!$e) {
            //create new event
            echo "new event\n";
            $e = $this->_newEvent($data, $bookId);
        } else {
            //event exist
            echo "existing event\n";
            $e = $this->update($data, $bookId);
        }
        $this->e = $e;
        $this->em->flush($this->e);
        return $this->e;
    }
    
    public function update($data, $bookId = 1) 
    {
        $event_id = $data->event_id;
        $e = $this->_exists('Event', $bookId, 'event_id', $event_id);
        if (!$e) {
            //create new sport
            echo "new event\n";
            $e = $this->create($data, $bookId);
        } else {
            //update sport data if any
            echo "updating existing event\n";
            $e = $this->_updateEvent($data, $e);
        }
        $this->e = $e;
        $this->em->flush($this->e);
        return $this->e;
    }
    
    private function _newEvent($data, $bookId)
    {
        $e = new EEvent();
        $e = $e->setBookId($bookId)
                ->setEventId($data->event_id);
        if ($data->event_name) {
           $e = $e->setName($data->event_name);
        }
        if ($data->sport_id){
            $s = $this->sport->create($data, $bookId);
            $e = $e->setSport($s);
        }
        $this->em->persist($e);
        return $e;
    }
    
    private function _updateEvent($data, $e)
    {
        if ($data->event_name) {
           $e = $e->setName($data->event_name);
        }
        $this->em->persist($e);
        return $e;
    }
    
    
}

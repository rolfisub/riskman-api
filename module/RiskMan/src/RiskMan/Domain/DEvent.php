<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain;
use RiskMan\Domain\DomainObject;
use RiskMan\Entity\Feed\Event as EEvent;
use RiskMan\Entity\Feed\Sport;
use RiskMan\Entity\Feed\League;
use RiskMan\Entity\Feed\Region;

/**
 * Description of Event
 *
 * @author rolf
 */
class DEvent extends DomainObject
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
     * constructor TODO: Annotations
     */
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->em = $em;
    }
    
    //POST
    public function create($data, $bookId = 1)
    {
        $event_id = $data->event_id;
        $e = $this->_getFeedEntity('RiskMan\Entity\Feed\Event', $bookId, 'event_id', $event_id);
        if (!$e) {
            //create new event
            echo "new event\n";
            $e = $this->_newEvent($bookId, $data);
        } else {
            //event exist
            echo "existing event\n";
            
        }
        $this->e = $e;
        $this->em->flush();
        var_dump($this->e);die("test");
    }
    
    private function _newEvent($bookId, $data)
    {
        var_dump($data);
        $e = new EEvent();
        $e = $e->setBookId($bookId)
                ->setEventId($data->event_id);
        if ($data->event_name) {
           $e = $e->setName($data->event_name);
        }
        if ($data->sport_id){
            $sport_id = $data->sport_id;
            $s = $this->_getFeedEntity('RiskMan\Entity\Feed\Sport', $bookId, 'sport_id', $sport_id);
            if (!$s) {
                //create new sport
                echo "new sport\n";
                $s = $this->_newSport($bookId, $data);
            } else {
                //update sport data if any
                echo "existing sport\n";
                if ($data->sport_name){
                    if($s->getName() != $data->sport_name){
                        $s = $s->setName($data->sport_name);
                    }
                }
            }
            $e = $e->setSport($s);
            var_dump($s);
        }
        $this->em->persist($e);
        return $e;
    }
    
    private function _newSport($bookId, $data)
    {
        $s = new Sport();
        $s = $s->setBookId($bookId);
        if($data->sport_name) {
            $s = $s->setName ($data->sport_name);
        }
        $this->em->persist($s);
        return $s;
    }
    
    private function _getFeedEntity($class, $book_id, $ref_field, $value) 
    {
        return $this->_findBy(
            $class,
            [
                $ref_field => $value,
                'book_id' => $book_id
            ]
        );
    }
    
}

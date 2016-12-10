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
     * @var RiskMan\Entity\Feed\Sport
     */
    protected $s;
    
    /*
     * constructor TODO: Annotations
     */
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->em = $em;
    }
    //POST
    public function create($data, $book_id = 1)
    {
        $event_id = $data->event_id;
        $this->e = $this->_getFeedEntity('RiskMan\Entity\Feed\Event', $book_id, 'event_id', $event_id);
        if (!$this->e) {
            //create new event
            echo "new event\n";
            $this->e = $this->_newEvent($book_id, $data);
        } else {
            //event exist
            echo "existing event\n";
        }
                
        var_dump($this->e);die("test");
    }
    
    private function _newEvent($book_id, $data)
    {
        var_dump($data);
        $e = new EEvent();
        $e->book_id = $book_id;
        $e->event_id = $data->event_id;
        if ($data->event_name) {
           $e->name = $data->event_name; 
        }
        if ($data->sport_id){
            $sport_id = $data->sport_id;
            $this->s = $this->_getFeedEntity('RiskMan\Entity\Feed\Sport', $book_id, 'sport_id', $sport_id);
            if (!$this->s) {
                //create new sport
                echo "new sport\n";
                $this->s = $this->_newSport($book_id, $data);
            } else {
                //update sport data if any
                echo "existing sport\n";
            }
            $this->e->sport = $this->s;
        }
        $this->em->persist($e);
        $this->em->flush();
        return $e;
    }
    
    private function _newSport($book_id, $data)
    {
        $s = new Sport();
        $s->book_id = $book_id;
        $s->sport_id = $data->sport_id;
        if ($data->sport_name) {
            $s->name = $data->sport_name;
        }
        $this->em->persist($s);
        $this->em->flush();
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

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Model\Feed;
use RiskMan\Model\Feed\ModelFeedObject;
use Doctrine\ORM\EntityManager;
use RiskMan\Entity\Feed\Event as EEvent;
/**
 * Description of Event
 *
 * @author rolf
 */
class Event extends ModelFeedObject
{
    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    
    public function __construct(EntityManager $em) 
    {
        parent::__construct($em);
        if(null === $this->em){
            $this->em = $em;
        }
        $this->entity_path .= 'Event';
    }
    
    public function getEvent($eventId, $bookId)
    {
        $e = $this->_findOneBy($this->entity_path, [
            'event_id' => $eventId,
            'book_id' => $bookId
        ]);
        return $this->_toArray($e);
    }
    
    public function newEvent($data, $bookId)
    {
        $e = new EEvent();
        $e->setBookId($bookId)
            ->setEventId($data->event_id);
        if ($data->event_name) {
           $e->setName($data->event_name);
        }
        $this->em->persist($e);
        $this->em->flush();
        return $this->_toArray($e);
    }
    
    protected function _toArray(EEvent $e)
    {
        if(!$e) {
            return false;
        }
        return [
            'id' => $e->getId(),
            'event_id' => $e->getEventId(),
            'event_name' => $e->getName()
        ];
    }
}

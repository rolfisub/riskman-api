<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Model\Feed;
use RiskMan\Model\Feed\ModelFeedObject;
use Doctrine\ORM\EntityManager;
use RiskMan\Entity\Feed\Sport as ESport;
/**
 * Description of Sport
 *
 * @author rolf
 */
class Sport extends ModelFeedObject
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
        $this->entity_path .= 'Sport';
    }
    
    public function getSport($sportId, $bookId)
    {
        $e = $this->_findOneBy($this->entity_path, [
            'sport_id' => $sportId,
            'book_id' => $bookId
        ]);
        return $this->_toArray($e);
    }
    
    public function newSport($data, $bookId)
    {
        $e = new ESport();
        $e = $e->setBookId($bookId)
                ->setSportId($data->sport_id);
        if ($data->sport_name) {
           $e = $e->setName($data->sport_name);
        }
        $this->em->persist($e);
        $this->em->flush();
        return $this->_toArray($e);
    }
    
    protected function _toArray(ESport $e)
    {
        if(!$e) {
            return false;
        }
        return [
            'id' => $e->getId(),
            'sport_id' => $e->getSportId(),
            'sport_name' => $e->getName()
        ];
    }
}

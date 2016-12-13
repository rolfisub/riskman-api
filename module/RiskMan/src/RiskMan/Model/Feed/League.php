<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Model\Feed;
use RiskMan\Model\Feed\ModelFeedObject;
use Doctrine\ORM\EntityManager;
use RiskMan\Entity\Feed\League as ELeague;
/**
 * Description of League
 *
 * @author rolf
 */
class League extends ModelFeedObject
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
        $this->entity_path .= 'League';
    }
    
    public function getLeague($leagueId, $bookId)
    {
        $e = $this->_findOneBy($this->entity_path, [
            'league_id' => $leagueId,
            'book_id' => $bookId
        ]);
        return $this->_toArray($e);
    }
    
    public function newLeague($data, $bookId)
    {
        $e = new ELeague();
        $e->setBookId($bookId)
            ->setLeagueId($data->league_id);
        if ($data->league_name) {
            $e->setName($data->league_name);
        }
        $this->em->persist($e);
        $this->em->flush();
        return $this->_toArray($e);
    }
    
    protected function _toArray(ELeague $e)
    {
        if(!$e) {
            return false;
        }
        return [
            'id' => $e->getId(),
            'league_id' => $e->getLeagueId(),
            'league_name' => $e->getName()
        ];
    }
}

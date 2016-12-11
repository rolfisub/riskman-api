<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use RiskMan\Domain\Feed\DomainFeedObject;
use RiskMan\Entity\Feed\League as ELeague;


/**
 * Description of League
 *
 * @author rolf
 */
class League extends DomainFeedObject
{
    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    /*
     * @var RiskMan\Entity\Feed\League
     */
    protected $l;
    
    /*
     * constructor TODO: Annotations
     */
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->em = $em;
    }
    
    //POST
    public function create ($data, $bookId)
    {
        $league_id = $data->league_id;
        $l = $this->_exists('League', $bookId, 'league_id', $league_id);
        if (!$l) {
            //create new league
            echo "creating new league\n";
            $l = $this->_newLeague($data, $bookId);
        } else {
            //update league data if any
            echo "existing league\n";
            $l = $this->update($data, $bookId, $l);
        }
        $this->l = $l;
        $this->em->flush();
        return $this->l;
    }
    
    public function update ($data, $bookId, $l = null)
    {
        $league_id = $data->league_id;
        if(!$l){
            $l = $this->_exists('League', $bookId, 'league_id', $league_id);
        }
        if (!$l) {
            //create new league
            echo "new league\n";
            $l = $this->create($data, $bookId);
        } else {
            //update league data if any
            echo "updating existing league\n";
            $l = $this->_updateLeague($data, $l);
        }
        $this->l = $l;
        $this->em->flush();
        return $this->l;
    }
    
    private function _newLeague ($data, $bookId)
    {
        
        $l = new ELeague();
        $l = $l->setBookId($bookId)
                ->setLeagueId($data->league_id);
        if($data->league_name) {
            $l = $l->setName ($data->league_name);
        }
        $this->em->persist($l);
        return $l;
    }
    
    private function _updateLeague ($data, $l)
    {
        if($data->league_name) {
            $l = $l->setName ($data->league_name);
        }
        $this->em->persist($l);
        return $l;
    }
    
    
    
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain;
use RiskMan\Domain\DomainObject;
use RiskMan\Entity\Feed\Sport as ESport;


/**
 * Description of Event
 *
 * @author rolf
 */
class Sport extends DomainObject
{
    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
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
    public function create ($data, $bookId = 1)
    {
        $sport_id = $data->sport_id;
        $s = $this->_exists('Sport', $bookId, 'sport_id', $sport_id);
        if (!$s) {
            //create new sport
            echo "creating new sport\n";
            $s = $this->_newSport($data, $bookId);
        } else {
            //update sport data if any
            echo "existing sport\n";
            $s = $this->update($data, $bookId);
        }
        $this->s = $s;
        $this->em->flush($this->s);
        return $this->s;
    }
    
    public function update ($data, $bookId = 1)
    {
        $sport_id = $data->sport_id;
        $s = $this->_exists('Sport', $bookId, 'sport_id', $sport_id);
        if (!$s) {
            //create new sport
            echo "new sport\n";
            $s = $this->create($data, $bookId);
        } else {
            //update sport data if any
            echo "updating existing sport\n";
            $s = $this->_updateSport($data, $s);
        }
        $this->s = $s;
        $this->em->flush($this->s);
        return $this->s;
    }
    
    private function _newSport ($data, $bookId)
    {
        $s = new ESport();
        $s = $s->setBookId($bookId)
                ->setSportId($data->sport_id);
        if($data->sport_name) {
            $s = $s->setName ($data->sport_name);
        }
        $this->em->persist($s);
        return $s;
    }
    
    private function _updateSport ($data, $s)
    {
        if($data->sport_name) {
            $s = $s->setName ($data->sport_name);
        }
        $this->em->persist($s);
        return $s;
    }
    
    
    
}

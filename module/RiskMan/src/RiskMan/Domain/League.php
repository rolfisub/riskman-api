<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain;
use RiskMan\Domain\DomainObject;
use RiskMan\Entity\Feed\League as ELeague;


/**
 * Description of League
 *
 * @author rolf
 */
class League extends DomainObject
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
    public function create($data, $bookId = 1)
    {
        return new ELeague();
    }
    
    
    private function _newLeague($bookId, $data)
    {
        $l = new ELeague();
        $l = $l->setBookId($bookId);
        if($data->league_name) {
            $l = $l->setName ($data->league_name);
        }
        $this->em->persist($l);
        return $l;
    }
    
    
    
}

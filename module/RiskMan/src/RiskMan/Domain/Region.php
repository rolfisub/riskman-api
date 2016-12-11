<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain;
use RiskMan\Domain\DomainFeedObject;
use RiskMan\Entity\Feed\Region as ERegion;


/**
 * Description of Event
 *
 * @author rolf
 */
class Region extends DomainFeedObject
{
    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    /*
     * @var RiskMan\Entity\Feed\League
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
    public function create($data, $bookId = 1)
    {
        
    }
    
    
    
    
    
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain;
use Doctrine\ORM\EntityManager;
/**
 * Description of DomainObject
 *
 * @author rolf
 */
abstract class DomainObject 
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    
    public function __construct(EntityManager $em)
    {
        if(null === $this->em){
            $this->em = $em;
        }
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Model;
use Doctrine\ORM\EntityManager;

/**
 * Description of ModelObject
 *
 * @author rolf
 */
abstract class ModelObject 
{
    
    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    
    public function __construct(EntityManager $em) 
    {
        if(null === $this->em){
            $this->em = $em;
        }
    }
    
    protected function _findOneBy($class, $array)
    {
        return $this->em->getRepository($class)->findOneBy($array);
    }
}

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
    
    protected function _getFeedEntity($class, $book_id, $ref_field, $value) 
    {
        return $this->_findBy(
            $class,
            [
                $ref_field => $value,
                'book_id' => $book_id
            ]
        );
    }
    
    protected function _findBy($class, $array)
    {
        return $this->em->getRepository($class)->findOneBy($array);
    }
    
    protected function _exists($entity, $bookId, $idField, $id)
    {
        return $this->_getFeedEntity('RiskMan\\Entity\\Feed\\' . $entity, $bookId, $idField, $id); 
    }
}

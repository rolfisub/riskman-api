<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of DomainFactory
 *
 * @author rolf
 */
class DomainFactory implements AbstractFactoryInterface
{
    protected $objects;
    
    public function construct()
    {
        $this->objects = array('DEvent');
    }
    
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        if(in_array($requestedName, $this->objects)) {
            return true;
        }
        return false;
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        if (class_exists($requestedName)) {
            //TODO: get entity manager
            
            return new $requestedName();
        }
        return false;
    }
}

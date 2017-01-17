<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Model\Feed;
use RiskMan\AbstractFactoryServiceClass;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of ModelFeedFactory
 *
 * @author rolf
 */
class ModelFeedFactory extends AbstractFactoryServiceClass implements AbstractFactoryInterface 
{
    public function __construct() 
    {
        $objects = array(
            0 => 'RiskMan\\Model\\Feed\\Event',
            1 => 'RiskMan\\Model\\Feed\\Sport',
            2 => 'RiskMan\\Model\\Feed\\League',
            3 => 'RiskMan\\Model\\Feed\\Region',
        );
        parent::__construct($objects);
    }
    
    
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        return $this->can($name);
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        return $this->create($serviceLocator, $name);
    } 
}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BetRadar\Mapper;
use RiskMan\AbstractFactoryServiceClass;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of BetRadarMsgFactory
 *
 * @author rolf
 */
class BetRadarMsgFactory extends AbstractFactoryServiceClass implements AbstractFactoryInterface 
{
    public function __construct() 
    {
        $objects = array(
            0 => 'RiskMan\\BetRadar\\Mapper\\BetRadarMsg'
        );
        parent::__construct($objects);
    }
    
    
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        return $this->can($requestedName);
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        $adapter = $serviceLocator->get('DatabaseService');
        $table = $this->getTableName($requestedName);
        $thisname = $this->getShortName($requestedName);
        return new $requestedName($adapter, $table, $thisname);
    }
}

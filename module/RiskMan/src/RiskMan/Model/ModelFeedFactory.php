<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Model;
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
            0 => 'RiskMan\Model\Feed\Event',
            1 => 'RiskMan\Model\Feed\Sport',
            2 => 'RiskMan\Model\Feed\League',
            3 => 'RiskMan\Model\Feed\Region',
            4 => 'RiskMan\Model\Feed\Odd',
            5 => 'RiskMan\Model\Feed\OddSelection',
            6 => 'RiskMan\Model\Bet\Single',
            7 => 'RiskMan\Model\Bet\Multiple',
            8 => 'RiskMan\Model\Bet\MultipleSelection',
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
        if($thisname == 'oddselection') {
            $thisname = 'odd_selection';
        }
        if($thisname == 'multipleselection') {
            $thisname = 'multiple_selection';
        }
        return new $requestedName($adapter, $table, $thisname);
    }
    
     
    
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Model\Feed;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of ModelFeedFactory
 *
 * @author rolf
 */
class ModelFeedFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        $objects = array(
            0 => 'RiskMan\Model\Feed\Event',
            1 => 'RiskMan\Model\Feed\Sport',
            2 => 'RiskMan\Model\Feed\League',
            3 => 'RiskMan\Model\Feed\Region',
        );
        return in_array($requestedName, $objects);
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        if (class_exists($requestedName)) {
            $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
            switch ($requestedName){
                case 'RiskMan\Model\Feed\Event':
                    echo "creating model Event\n";
                    return new $requestedName($em);
                    break;
                case 'RiskMan\Model\Feed\Sport':
                    echo "creating model Sport\n";
                    return new $requestedName($em);
                    break;
                case 'RiskMan\Model\Feed\League':
                    echo "creating model League\n";
                    return new $requestedName($em);
                    break;
                case 'RiskMan\Model\Feed\Region':
                    echo "creating model Region\n";
                    return new $requestedName($em);
                    break;
            }
        }
        return false;
    }
}

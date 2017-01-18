<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of DomainFactory
 *
 * @author rolf
 */
class DomainFeedFactory implements AbstractFactoryInterface
{
    
    
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        $objects = array(
            0 => 'RiskMan\\Domain\\Feed\\Event'
        );
        return in_array($requestedName, $objects);
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        
        if (class_exists($requestedName)) {
            echo "requested name = " . $requestedName . "\n";
            switch ($requestedName){
                case 'RiskMan\\Domain\\Feed\\Event':
                    echo "creating domain Event\n";
                    $sport  = $serviceLocator->get('RiskMan\\Model\\Feed\\Sport');
                    $league = $serviceLocator->get('RiskMan\\Model\\Feed\\League');
                    $region = $serviceLocator->get('RiskMan\\Model\\Feed\\Region');
                    $event  = $serviceLocator->get('RiskMan\\Model\\Feed\\Event');
                    $o = new $requestedName($event, $sport, $league, $region);
                    echo " ...done\n";
                    return $o;
            }
        }
        else {
            echo "you are looking for a class that doesn't exist : " . $requestedName;
            die();
        }
        return false;
    }
}

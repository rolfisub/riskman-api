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
            0 => 'RiskMan\Domain\Feed\Event',
            1 => 'RiskMan\Domain\Feed\Sport',
            2 => 'RiskMan\Domain\Feed\League',
            3 => 'RiskMan\Domain\Feed\Region',
        );
        return in_array($requestedName, $objects);
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        if (class_exists($requestedName)) {
            $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
            switch ($requestedName){
                case 'RiskMan\Domain\Feed\Event':
                    echo "creating domain Event\n";
                    $sport = $serviceLocator->get('RiskMan\Domain\Feed\Sport');
                    $league = $serviceLocator->get('RiskMan\Domain\Feed\League');
                    $region = $serviceLocator->get('RiskMan\Domain\Feed\Region');
                    return new $requestedName($em, $sport, $league, $region);
                    break;
                case 'RiskMan\Domain\Feed\Sport':
                    echo "creating domain Sport\n";
                    return new $requestedName($em);
                    break;
                case 'RiskMan\Domain\Feed\League':
                    echo "creating domain League\n";
                    return new $requestedName($em);
                    break;
                case 'RiskMan\Domain\Feed\Region':
                    echo "creating domain Region\n";
                    return new $requestedName($em);
                    break;
            }
        }
        return false;
    }
}

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
    
    
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        $objects = array(
            0 => 'RiskMan\Domain\Event',
            1 => 'RiskMan\Domain\Sport',
            2 => 'RiskMan\Domain\League',
            3 => 'RiskMan\Domain\Region',
        );
        return in_array($requestedName, $objects);
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        if (class_exists($requestedName)) {
            $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
            switch ($requestedName){
                case 'RiskMan\Domain\Event':
                    echo "creating domain event\n";
                    $sport = $serviceLocator->get('RiskMan\Domain\Sport');
                    $league = $serviceLocator->get('RiskMan\Domain\League');
                    $region = $serviceLocator->get('RiskMan\Domain\Region');
                    return new $requestedName($em, $sport, $league, $region);
                    break;
                case 'RiskMan\Domain\Sport':
                    echo "creating domain Sport\n";
                    return new $requestedName($em);
                    break;
                case 'RiskMan\Domain\League':
                    echo "creating domain League\n";
                    return new $requestedName($em);
                    break;
                case 'RiskMan\Domain\Region':
                    echo "creating domain Region\n";
                    return new $requestedName($em);
                    break;
            }
        }
        return false;
    }
}

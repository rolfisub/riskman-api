<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;

use RiskMan\BookOptions\BookOptions;
use RiskMan\Suggestive\Suggestive;


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
            0 => 'RiskMan\\Domain\\Feed\\Event',
            1 => 'RiskMan\\Domain\\Feed\\Odd',
            2 => 'RiskMan\\Domain\\Feed\\OddSelection'
        );
        return in_array($requestedName, $objects);
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        
        if (class_exists($requestedName)) {
            //echo "requested name = " . $requestedName . "\n";
            switch ($requestedName){
                case 'RiskMan\\Domain\\Feed\\Event':
              //      echo "creating domain Event\n";
                    $sport  = $serviceLocator->get('RiskMan\\Model\\Feed\\Sport');
                    $league = $serviceLocator->get('RiskMan\\Model\\Feed\\League');
                    $region = $serviceLocator->get('RiskMan\\Model\\Feed\\Region');
                    $event  = $serviceLocator->get('RiskMan\\Model\\Feed\\Event');
                    $bo = $serviceLocator->get(BookOptions::class);
                    $o = new $requestedName($event, $sport, $league, $region, $bo);
                //    echo " ...done\n";
                    return $o;
                    
                case 'RiskMan\\Domain\\Feed\\Odd':
                  //  echo "creating domain Odd\n";
                    $e = $serviceLocator->get('RiskMan\\Model\\Feed\\Event');
                    $odd = $serviceLocator->get('RiskMan\\Model\\Feed\\Odd');
                    $bo = $serviceLocator->get(BookOptions::class);
                    $o = new $requestedName($e, $odd, $bo);
                    //echo " ...done\n";
                    return $o;
                    
                case 'RiskMan\\Domain\\Feed\\OddSelection':
                   // echo "creating domain OddSelection\n";
                    $e = $serviceLocator->get('RiskMan\\Model\\Feed\\Event');
                    $o = $serviceLocator->get('RiskMan\\Model\\Feed\\Odd');
                    $os = $serviceLocator->get('RiskMan\\Model\\Feed\\OddSelection');
                    $bo = $serviceLocator->get(BookOptions::class);
                    $ss = $serviceLocator->get(Suggestive::class);
                    $or = new $requestedName($o, $os, $e, $bo, $ss);
                   // echo " ...done\n";
                    return $or;
            }
        }
        else {
            echo "you are looking for a class that doesn't exist : " . $requestedName;
            die();
        }
        return false;
    }
}

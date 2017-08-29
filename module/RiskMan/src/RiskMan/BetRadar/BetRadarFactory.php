<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BetRadar;

use RiskMan\BetRadar\Config;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of BetRadarFactory
 *
 * @author rolf
 */
class BetRadarFactory  implements AbstractFactoryInterface
{
    
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        
        $objects = array(
            0 => 'RiskMan\\BetRadar\\BetRadar',
        );
        
        return in_array($requestedName, $objects);
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        if (class_exists($requestedName)) {
            //echo "requested name = " . $requestedName . "\n";
            switch ($requestedName){
                case 'RiskMan\\BetRadar\\BetRadar':
                    //echo "creating domain Player\n";
                    /**
                     * Dependencies
                     */
                    
                    $config = new Config([
                        //add configuration here
                    ]);
                    $mapper = $serviceLocator->get('RiskMan\\BetRadar\\Mapper\\BetRadarMsg');
                    
                    $o = new $requestedName(
                        $config,
                        $mapper
                    );
                    //echo " ...done\n";
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

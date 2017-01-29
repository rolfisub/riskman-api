<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Bet;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of DomainFactory
 *
 * @author rolf
 */
class DomainBetFactory implements AbstractFactoryInterface
{
    
    
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        $objects = array(
            0 => 'RiskMan\\Domain\\Bet\\Single',
            1 => 'RiskMan\\Domain\\Bet\\Multiple',
        );
        return in_array($requestedName, $objects);
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        
        if (class_exists($requestedName)) {
            echo "requested name = " . $requestedName . "\n";
            switch ($requestedName){
                case 'RiskMan\\Domain\\Bet\\Single':
                    echo "creating domain Single\n";
                    
                    //MS $ms, Event $e, Odd $o, OddSelection $os
                    $e = $serviceLocator->get('RiskMan\\Model\\Feed\\Event');
                    $o = $serviceLocator->get('RiskMan\\Model\\Feed\\Odd');
                    $os = $serviceLocator->get('RiskMan\\Model\\Feed\\OddSelection');
                    
                    $single  = $serviceLocator->get('RiskMan\\Model\\Bet\\Single');
                    $o = new $requestedName($single, $e, $o, $os);
                    echo " ...done\n";
                    return $o;
                case 'RiskMan\\Domain\\Bet\\Multiple':
                    echo "creating domain Multiple\n";
                    
                    //MS $ms, Event $e, Odd $o, OddSelection $os
                    $e = $serviceLocator->get('RiskMan\\Model\\Feed\\Event');
                    $o = $serviceLocator->get('RiskMan\\Model\\Feed\\Odd');
                    $os = $serviceLocator->get('RiskMan\\Model\\Feed\\OddSelection');
                    
                    $multiple  = $serviceLocator->get('RiskMan\\Model\\Bet\\Multiple');
                    $multipleselection  = $serviceLocator->get('RiskMan\\Model\\Bet\\MultipleSelection');
                    $o = new $requestedName($multiple, $multipleselection, $e, $o, $os);
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

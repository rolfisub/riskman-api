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
            2 => 'RiskMan\\Domain\\Bet\\MultipleSelection'
        );
        return in_array($requestedName, $objects);
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        
        if (class_exists($requestedName)) {
            //echo "requested name = " . $requestedName . "\n";
            $de = $serviceLocator->get('RiskMan\\Domain\\Feed\\Event');
            $do = $serviceLocator->get('RiskMan\\Domain\\Feed\\Odd');
            $dos = $serviceLocator->get('RiskMan\\Domain\\Feed\\OddSelection');
            $dp = $serviceLocator->get('RiskMan\\Domain\\Player');
            $e = $serviceLocator->get('RiskMan\\Model\\Feed\\Event');
            $od = $serviceLocator->get('RiskMan\\Model\\Feed\\Odd');
            $os = $serviceLocator->get('RiskMan\\Model\\Feed\\OddSelection');
            switch ($requestedName){
                case 'RiskMan\\Domain\\Bet\\Single':
                    //echo "creating domain Single\n";
                    $single  = $serviceLocator->get('RiskMan\\Model\\Bet\\Single');
                    $o = new $requestedName(
                        $serviceLocator,
                        $de,
                        $do,
                        $dos,
                        $dp,
                        $single, 
                        $e, 
                        $od, 
                        $os                        
                    );
                    
                    //echo " ...done\n";
                    return $o;
                case 'RiskMan\\Domain\\Bet\\Multiple':
                    //echo "creating domain Multiple\n";
                  
                    $multiple  = $serviceLocator->get('RiskMan\\Model\\Bet\\Multiple');
                    $multipleselection  = $serviceLocator->get('RiskMan\\Model\\Bet\\MultipleSelection');
                    $domainmultipleselection  = $serviceLocator->get('RiskMan\\Domain\\Bet\\MultipleSelection');
                    $o = new $requestedName(
                        $serviceLocator,    
                        $de,
                        $do,
                        $dos,
                        $dp,
                        $multiple, 
                        $multipleselection, 
                        $domainmultipleselection, 
                        $e, 
                        $od, 
                        $os
                    );
                    //echo " ...done\n";
                    return $o;
                case 'RiskMan\\Domain\\Bet\\MultipleSelection':
                    //echo "creating domain MultipleSelection\n";
                    $multiple  = $serviceLocator->get('RiskMan\\Model\\Bet\\Multiple');
                    $multipleselection  = $serviceLocator->get('RiskMan\\Model\\Bet\\MultipleSelection');
                    
                    $o = new $requestedName(
                        $serviceLocator,
                        $de,
                        $do,
                        $dos,
                        $dp,
                        $multipleselection, 
                        $multiple, 
                        $e, 
                        $od, 
                        $os
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

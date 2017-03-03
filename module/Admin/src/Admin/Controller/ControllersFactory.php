<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Controller;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Description of ControllersFactory
 *
 * @author rolf
 */
class ControllersFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        $objects = array(
            0 => 'Admin\\Controller\\IndexController',
            1 => 'Admin\\Controller\\AuthController',
        );
        return in_array($requestedName, $objects);
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        if (class_exists($requestedName)) {
            switch ($requestedName){
                case 'Admin\\Controller\\IndexController':
                    $o = new $requestedName($serviceLocator);
                    return $o;
                case 'Admin\\Controller\\AuthController':
                    $o = new $requestedName($serviceLocator);
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

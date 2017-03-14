<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Mapper;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Description of MapperFactory
 *
 * @author rolf
 */
class MapperFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        $objects = array(
            0 => 'Admin\\Mapper\\StatsMapper',
        );
        return in_array($requestedName, $objects);
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) 
    {
        if (class_exists($requestedName)) {
            switch ($requestedName){
                case 'Admin\\Mapper\\StatsMapper':
                    $adapter = $serviceLocator->get('DatabaseService');
                    $o = new $requestedName($adapter);
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
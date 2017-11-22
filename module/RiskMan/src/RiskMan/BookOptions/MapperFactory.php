<?php
/**
 * Database factory
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2017 Rolfitech, Inc.
 */

namespace RiskMan\BookOptions;
use RiskMan\BookOptions\Mapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MapperFactory implements FactoryInterface
{
    public function createService (ServiceLocatorInterface $serviceLocator) 
    {
        $a = $serviceLocator->get('DatabaseService');
        return new Mapper($a);
    }
}
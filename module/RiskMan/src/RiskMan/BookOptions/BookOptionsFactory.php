<?php
/**
 * BookOptionsModel factory
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2017 Rolfitech, Inc.
 */

namespace RiskMan\BookOptions;
use RiskMan\BookOptions\BookOptions;
use RiskMan\BookOptions\Mapper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BookOptionsFactory implements FactoryInterface
{
    public function createService (ServiceLocatorInterface $serviceLocator) 
    {
        $mapper = $serviceLocator->get(Mapper::class);
        return new BookOptions($mapper);
    }
}
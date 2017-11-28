<?php
/**
 * BookCurrencyModel factory
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2017 Rolfitech, Inc.
 */

namespace RiskMan\BookCurrency;
use RiskMan\BookCurrency\Mapper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MapperFactory implements FactoryInterface
{
    public function createService (ServiceLocatorInterface $serviceLocator) 
    {
        $adapter = $serviceLocator->get('DatabaseService');
        return new Mapper($adapter);
    }
}
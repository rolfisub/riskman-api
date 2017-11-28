<?php
/**
 * BookCurrencyModel factory
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2017 Rolfitech, Inc.
 */

namespace RiskMan\BookCurrency;
use RiskMan\BookOptions\BookOptions;
use RiskMan\BookCurrency\BookCurrency;
use RiskMan\BookCurrency\Mapper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BookCurrencyFactory implements FactoryInterface
{
    public function createService (ServiceLocatorInterface $serviceLocator) 
    {
        $options = $serviceLocator->get(BookOptions::class);
        $mapper = $serviceLocator->get(Mapper::class);
        return new BookCurrency($options, $mapper);
    }
}
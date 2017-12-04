<?php
/**
 * BookCentlineModel factory
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2017 Rolfitech, Inc.
 */

namespace RiskMan\BookCurrency;
use RiskMan\BookCentline;
use RiskMan\BookOptions\BookOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BookCentlineFactory implements FactoryInterface
{
    public function createService (ServiceLocatorInterface $serviceLocator) 
    {
        $options = $serviceLocator->get(BookOptions::class);
        return new BookCentline($options);
    }
}
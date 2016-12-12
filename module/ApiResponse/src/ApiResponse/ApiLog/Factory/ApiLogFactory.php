<?php
/**
 * ApiLogFactory
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2016 Trxadegroup, Inc.
 */

namespace ApiResponse\ApiLog\Factory;
use ApiResponse\ApiLog\ApiLog;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ApiLogFactory implements FactoryInterface
{
    public function createService (ServiceLocatorInterface $serviceLocator) 
    {
        $log_model = $serviceLocator->get('ApiLogModel');
        return new ApiLog($log_model);
    }
}

<?php
/**
 * ApiLogModelFactory
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2016 Trxadegroup, Inc.
 */

namespace ApiResponse\ApiLog\Factory;
use ApiResponse\ApiLog\ApiLogModel;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ApiLogModelFactory implements FactoryInterface
{
    
    public function createService (ServiceLocatorInterface $serviceLocator) 
    {
        $config = $serviceLocator->get('config');
        $adapter_service = $config['database_config']['database_service'];
        $adapter = $serviceLocator->get($adapter_service);
        return new ApiLogModel($adapter);
    }
}

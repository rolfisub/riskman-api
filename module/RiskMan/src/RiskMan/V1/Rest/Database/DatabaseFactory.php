<?php
/**
 * Database factory
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2016 Trxadegroup, Inc.
 */

namespace RiskMan\Database;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DatabaseFactory implements FactoryInterface
{
    public function createService (ServiceLocatorInterface $serviceLocator) 
    {
        $config = $serviceLocator->get('config');
        $config_key = $config['database_config']['database_config_key'];
        $adapter = new DbAdapter($config['db']['adapters'][$config_key]);
        return $adapter;
    }
}

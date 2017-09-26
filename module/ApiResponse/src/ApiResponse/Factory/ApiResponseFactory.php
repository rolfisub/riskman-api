<?php
/**
 * ApiResponseFactory
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2016 Trxadegroup, Inc.
 */

namespace ApiResponse\Factory;
use ApiResponse\ApiResponse;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ApiResponseFactory implements FactoryInterface 
{
    public function createService (ServiceLocatorInterface $serviceLocator) 
    {
//        $serverCallable = $serviceLocator->get('ZF\OAuth2\Service\OAuth2Server');
//        $oauthServer = $serverCallable();
        $oauthServer = null;
        $log = $serviceLocator->get('ApiLog');
        return new ApiResponse($log, $oauthServer);
    }
}

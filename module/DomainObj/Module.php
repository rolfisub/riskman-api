<?php
/**
 * Module config for DomainObj
 *
 * @package   DLMysql 
 * @author    Rolf
 * @copyright Rolf Bansbach
 */

namespace DomainObj;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\ResponseSender\SendResponseEvent;

class Module implements AutoloaderProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function onBootstrap(MvcEvent $e)
    {
        
        /*$app = $e->getTarget();
        $sendResponseListener = $app->getServiceManager()->get('SendResponseListener');
        $ApiResponse = $app->getServiceManager()->get('ApiResponse');
        $sendResponseListener->getEventManager()->attach(
            SendResponseEvent::EVENT_SEND_RESPONSE,  
            array(
                $ApiResponse, 
                'catchEvent'
            ), 
            1001
        );*/
        
    }
    
    
    
    
}
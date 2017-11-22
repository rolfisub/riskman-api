<?php
namespace RiskMan\Suggestive;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Riskman\Suggestive\Suggestive as SuggestiveModel;
use RiskMan\Suggestive\SuggestiveMapper;



/**
 * Zend abstract factory class
 *
 * @author rolf
 */
class SuggestiveFactory implements AbstractFactoryInterface
{
    
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        
        $objects = array(
            0 => SuggestiveModel::class,
            1 => SuggestiveMapper::class,
        );
        
        return in_array($requestedName, $objects);
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        if (class_exists($requestedName)) {
            switch ($requestedName){
                case SuggestiveModel::class:
                    //get dep instances here
                    $sm = $serviceLocator->get(SuggestiveMapper::class);
                    return new SuggestiveModel(
                        $sm
                    );
                case SuggestiveMapper::class:
                    //get dep instances here
                    $a = $serviceLocator->get('DatabaseService');
                    return new SuggestiveMapper(
                        $a
                    );
            }
        }
        else {
            echo "you are looking for a class that doesn't exist : " . $requestedName;
            die();
        }
        return false;
    }

}
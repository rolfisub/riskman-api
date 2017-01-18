<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan;

/**
 * Description of AbstractFactoryServiceClass
 *
 * @author rolf
 */
class AbstractFactoryServiceClass 
{
    protected $nps;
    
    //needs an array of namespaces
    public function __construct($namespace) 
    {
        if (is_array($namespace)) {
            $this->nps = $namespace;
        } else {
            //trow exception, only array of name spaces allowed
            // maybe in the future can check for existing classes
        }
    }
    
    //check if abstract factory can create service
    public function can($name)
    {
        return in_array($name, $this->nps);
    }
    
    //default behaviour is to create a object and inject service manager
    public function create($sm, $name)
    {
        if (class_exists($name) && $this->can($name)) {
            $v = new $name($sm);
            return $v;
        }
        return false;
    }
    
    protected function getShortName($name)
    {
        $f = new \ReflectionClass($name);
        return strtolower($f->getShortName());
    }
    
    protected function getTableName($name)
    {
        $short = $this->getShortName($name);
        return strtolower($short);
    }
    
}

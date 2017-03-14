<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Mapper;

use Zend\Db\Adapter\Adapter;
/**
 * Description of StatsMapper
 *
 * @author rolf
 */
class StatsMapper 
{
    protected $adapter;
    public function __construct(Adapter $adapter) 
    {
        $this->adapter = $adapter;
    }
    
    public function testMeMapper()
    {
        return [];
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Model;

use Admin\Mapper\StatsMapper;
/**
 * Description of Stats
 *
 * @author rolf
 */
class Stats 
{
    protected $stats;
    
    public function __construct(StatsMapper $stats) 
    {
        $this->stats = $stats;
    }
    
    public function testMe()
    {
       return $this->stats->testMeMapper();   
    }
    
}

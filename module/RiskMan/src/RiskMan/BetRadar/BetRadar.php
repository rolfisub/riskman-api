<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BetRadar;

use RiskMan\BetRadar\Config;
use RiskMan\BetRadar\Mapper\BetRadarMsg as Mapper;
use RiskMan\BetRadar\BetRadarMsg;

/**
 * Description of BetRadar
 *
 * @author rolf
 */
class BetRadar 
{
    /**
     * @access protected
     * 
     */
    protected $msg;
    
    /**
     * Constructor
     * @param  Config $config Configuration for specific Bet radar Feed
     * @param BetRadarMsg $msgMapper Description
     */
    public function __construct(Config $config, Mapper $msgMapper) 
    {
        
    }
    
    
    /**
     * Public API
     */
    public function createMsg(BetRadarMsg $msg)
    {
        $this->setMsg($msg);
        
        var_dump($this->msg->xml);die();
        
    }
    
    
    
    /**
     * Setters and Getters
     */
    public function setMsg(BetRadarMsg $msg)
    {
        $this->msg = $msg;
        return $this;
    }
    
    public function getMsg()
    {
        return $this->msg;
    }
    
    
}

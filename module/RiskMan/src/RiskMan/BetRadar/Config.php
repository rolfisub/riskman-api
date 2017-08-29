<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BetRadar;

/**
 * Description of Config
 *
 * @author rolf
 */
class Config 
{
    protected $config;
    /**
     * 
     * @param array $config configuration array
     */
    public function __construct(array $config) 
    {
        $this->config = $config;
    }
}

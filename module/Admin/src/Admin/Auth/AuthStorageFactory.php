<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Auth;

/**
 * Description of AuthStorageFactory
 *
 * @author rolf
 */
class AuthStorageFactory 
{
    public function __invoke($sm) 
    {
        
        return new \Admin\Auth\RiskManAuthStorage('admin_riskman');
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Suggestive;

use Zend\Db\Adapter\Adapter;
/**
 * Description of SuggestiveMapper
 *
 * @author rolf
 */
class SuggestiveMapper
{
    private $adapter;
    
    public function __construct(Adapter $a) {
        $this->adapter = $a;
    }
    
    
}

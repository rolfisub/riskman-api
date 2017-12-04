<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BookCentline;

use RiskMan\BookOptions\BookOptions;

/**
 * Description of BookCentline
 *
 * @author rolf
 */
class BookCentline 
{
    public $bookOptions;
    
    public function __construct(BookOptions $options) 
    {
        $this->bookOptions = $options;
    }
    
    
    
    
    
}

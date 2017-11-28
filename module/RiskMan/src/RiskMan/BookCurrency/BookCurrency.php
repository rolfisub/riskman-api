<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BookCurrency;

use RiskMan\BookOptions\BookOptions;
use RiskMan\BookCurrency\Mapper;
/**
 * Description of BookCurrency
 *
 * @author rolf
 */
class BookCurrency 
{
    protected $options;
    protected $mapper;
    
    public function __construct(BookOptions $options, Mapper $mapper) 
    {
        $this->options = $options;
        $this->mapper = $mapper;
    }
    
    /**
     * converts a value to usd rate
     * @param float $value
     * @param int $book_id
     * @return float
     */
    public function convertToUSD($value, $book_id)
    {
        $currency = $this->options->getOptions($book_id)->currency;
        $rate = $this->getUSDRate($currency);
        return (float)number_format($value / $rate, 2,'.', '');
    }
    
    /**
     * gets the current USD rate
     * @param string $currency
     * @return array
     */    
    private function getUSDRate($currency)
    {
        return $this->mapper->getUSDRate($currency)[0]['rate'];
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\OddFormat;

/**
 * Description of OddFormat
 * Helper class to convert between odd formats
 * @author rolf
 */
class OddFormat 
{
    /**
     * Supported odd formats
     */
    private $oddFormats = [
        'American',
        'Decimal'
    ];
    
    /**
     * Converts a value from one odd format to another
     * 
     * @param string $from oddFormat
     * @param string $to oddFormat
     * @param string $value value in question
     * @return float converted value
     */
    public function convertFromTo($from, $to, $value)
    {
        //if not a valid odd format
        if(!in_array($from, $this->oddFormats) || !in_array($to, $this->oddFormats)) {
            throw new \Exception('Invalid odd format provided to odd converter.', 500);
        }
        
        //validate value
        $validValue = $this->validateValue($from, $value);
        //convert if valid
        if($validValue) {
            if($from === $to) {
                return $value;
            }
            if($from === 'American' && $to === 'Decimal') {
                $value = $this->AmericanToDecimal($value);
            }
            if($from === 'Decimal' && $to === 'American') {
                $value = $this->DecimalToAmerican($value);
            }
        }
        return $value;
    }
    
    /**
     * Tries to convert a value from Decimal to American 
     * it assumes value is validated already
     * @param numeric $value
     */
    private function DecimalToAmerican ($value)
    {
        $value = (float)$value;
        if($value == 0){return $value;}
        if($value >= 2.0) {
            return round(($value - 1) * 100, 0);
        } else {
            return round(-100 / ($value - 1), 0);
        }
    }
    
    /**
     * Tries to convert a value from American to Decimal
     * it assumes value is validated already
     * @param numeric $value
     */
    private function AmericanToDecimal ($value)
    {
        if($value == 0){return $value;}
        if($value > 0) {
            return 1 + (abs($value) / 100);
        } else {
            return 1 + (100 / abs($value));
        }
    }
    
    /**
     * Determines if the value provided is in the odd format specified
     * @param type $from
     * @param type $value
     */
    private function validateValue($from, $value)
    {
        //check if value is not double or int
        if(!is_numeric($value)) {
            throw new \Exception('Value provided to odd converter is not numeric.', 500);
        }
        //validate american
        if($from === 'American')
        {
            if($value < 100 && $value >= -100){
                throw new \Exception('Value is not in American format', 500);
            }
        }
        //validate decimal
        if($from === 'Decimal') {
            if($value < 1 && $value != 0) {
                throw new \Exception('Value is not in Decimal format value = ' . $value, 500);
            }
        }
        
        //this is a valid value
        return true;
    }
    
}

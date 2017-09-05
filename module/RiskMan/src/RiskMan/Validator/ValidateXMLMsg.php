<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Validator;
use Zend\Validator\AbstractValidator;
/**
 * Description of ValidateDateTime
 *
 * @author rolf
 */
class ValidateXMLMsg extends AbstractValidator
{
    const MSG_ERRORVAL = 'InvalidXML';
    
    protected $messageTemplates = array(
        self::MSG_ERRORVAL => 'Invalid XML Document received, %value%',
    );
    
    public function isValid($value) 
    {
      
        $dom = new \DOMDocument();
        if(!$dom->loadXML($value)){
            $this->error(self::MSG_ERRORVAL, $value);
            return false;
        }
        return true;
    }  
}

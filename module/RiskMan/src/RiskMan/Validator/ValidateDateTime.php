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
class ValidateDateTime extends AbstractValidator
{
    const MSG_ERRORVAL = 'InvalidDate';
    
    protected $messageTemplates = array(
        self::MSG_ERRORVAL => 'Invalid Date received, %value%',
    );
    
    public function isValid($value) 
    {
      
        $tmp = strtotime($value);
        if ($tmp === FALSE) {
            $this->error(self::MSG_ERRORVAL, $value);
            return false;
        }

        return true;
    }  
}

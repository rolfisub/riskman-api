<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Validator;
use Zend\Validator\AbstractValidator;
/**
 * Description of ValidatePicksArray
 *
 * @author rolf
 */
class ValidatePicksArray extends AbstractValidator
{
    const MSG_ERRORVAL = 'NotArray';
    
    protected $messageTemplates = array(
        self::MSG_ERRORVAL => 'Picks value received is not an Array',
    );
    
    public function isValid($value) 
    {
        if (!is_array($value)) {
            $this->error(self::MSG_ERRORVAL);
            return false;
        }
        return true;
    }  
}

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
    const MSG_MINPICKS = 'MinPicks';
    const MSG_MAXPICKS = 'MaxPicks';
    
    
    
    protected $messageTemplates = array(
        self::MSG_ERRORVAL => 'Picks value received is not an Array',
        self::MSG_MINPICKS => 'Minimum picks not met, amount recieved: %value%',
        self::MSG_MAXPICKS => 'Maximum picks met, amount received %value%',
        
        //invalid picks structure
        self::MSG_ARRAYINVALIDSTRUCT => 'Invalid array structure detected.',
        
        //pick fields msgs
        self::MSG_PICKFIELDREQUIRED => 'Field %name% is required. Pick = %pick%',
        self::MSG_PICKALNUM => 'Field %name% must only contain alphanumeric characters, value = %value1%. Pick = %pick%',
        self::MSG_PICKFIELDLENGHT => 'Field %name% lenght value (%value1%) cannot be less than 1 or greater than 32 characters. Pick = %pick%',
        self::MSG_PICKISFLOAT => 'Field %name% must be a float. Pick = %pick%',
    );
    
    
    
    public function isValid($value) 
    {
        
        if (!is_array($value)) {
            $this->error(self::MSG_ERRORVAL);
            return false;
        }
        
        $size = sizeof($value);
        $maxPicks = 50;
        $minPicks = 2;
        
        if($size < $minPicks){
            $this->error(self::MSG_MINPICKS, $size);
            return false;
        }
        
        if($size > $maxPicks){
            $this->error(self::MSG_MAXPICKS, $size);
            return false;
        }
        
        
        //validate each pick
        /* 
        * multiple_selection_id (required, alphanum, max 32 chars)
        * event_id (required, alphanum, max 32 chars)
        * odd_id (required, alphanum, max 32 chars)
        * odd_selection_id (required, alphanum, max 32 chars)
        * odd (optional, isfloat)
        * points (optional, isfloat)
        */
        for ($x = 0; $x < sizeof($value); $x++){
            if(isset($value[$x])){
                
                $p = $value[$x];
                
                
                //validate fields that are IDs
                $vids = $this->_ValidateReqAlnMax(
                    [
                        'multiple_selection_id',
                        'event_id',
                        'odd_id',
                        'odd_selection_id',
                    ], 
                    $p,
                    $x
                );
                
                if(!$vids){
                    return false;
                }
                
                //validate odds and points
                if(isset($p['odd'])){
                    //is float number?
                    $v = $p['odd'];
                    $isFloat = new Zend\I18n\Validator\IsFloat();
                    if(!$isFloat->isValid($v)) {
                        $this->error(self::MSG_PICKISFLOAT,[
                            'name' => 'odd',
                            'pick' => $x
                        ]);
                        return false;
                    }
                }
                if(isset($p['points'])){
                    //is float number?
                    $v = $p['points'];
                    $isFloat = new Zend\I18n\Validator\IsFloat();
                    if(!$isFloat->isValid($v)) {
                        $this->error(self::MSG_PICKISFLOAT,[
                            'name' => 'points',
                            'pick' => $x
                        ]);
                        return false;
                    }
                }
                

            } else {
                $this->error(self::MSG_ARRAYINVALIDSTRUCT);
                return false;
            }    
        }
        var_dump($value);die();
        
        
        return true;
    }  
    
    
    private function _ValidateReqAlnMax($fields, $data, $pick) 
    {
        foreach ($fields as $key => $field) {
            //required
            if(!isset($data[$field])){
                $this->error(self::MSG_PICKFIELDREQUIRED, [
                    'name' => $field,
                    'pick' => $pick
                ]);
                return false;
            } else {
                $v = $data[$field];
                //alphanumeric
                $alnum = new Zend\I18n\Validator\Alnum();
                if(!$alnum->isValid($v)){
                    $this->error(self::MSG_PICKALNUM,[
                        'name' => $field,
                        'pick' => $pick,
                        'value1' => $v
                    ]);
                    return false;
                }
                //string lenght 32
                $strlen = new Zend\Validator\StringLength(['min' => 1, 'max' => 32]);
                if(!$strlen->isValid($v)){
                    $this->error(self::MSG_PICKFIELDLENGHT,[
                        'name' => $field,
                        'pick' => $pick,
                        'value1' => $v
                    ]);
                    return false;
                }
            }
        }
        return true;
    }
    
}

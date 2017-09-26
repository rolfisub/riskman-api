<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Bet;
use RiskMan\Domain\DomainObject;
use RiskMan\Domain\DomainResponse;

use RiskMan\Domain\Feed\Event;
use RiskMan\Domain\Feed\Odd;
use RiskMan\Domain\Feed\OddSelection;

use Zend\ServiceManager\ServiceLocatorInterface as SM;

/**
 * Description of DomainBetObject
 *
 * @author rolf
 */
class DomainBetObject extends DomainObject
{
    /*
     * @var Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $sm;
    /*
     * @var RiskMan\Domain\Feed\Event
     */
    protected $de;
    
    /*
     * @var RiskMan\Domain\Feed\Odd
     */
    protected $do;
    
    /*
     * @var RiskMan\Domain\Feed\OddSelection
     */
    protected $dos;
    
    /**
     * 
     * @var validationResponse
     * 
     */
    protected $validationResponse;
    //put your code here
    
    //create feed objects if necessary
    //optimisation for http requests
    
    public function __construct(SM $sm, Event $de, Odd $do, OddSelection $dos) 
    {
        $this->sm = $sm;
        $this->de = $de;
        $this->do = $do;
        $this->dos = $dos;
        $this->validationResponse = new DomainResponse([
            'code' => 422,
            'type' => 'Validation Error',
            'title' => 'Unprocessable Entity',
            'details'=> 'Failed Validation',
            'data' => []
        ]);
    }
    
    public function createOtherFeedObjects($data)
    {
        
        $data = json_decode(json_encode($data), true);
        
        //event_data
        if(isset($data['event_data'])) {
            $problem = $this->validateAndCreate(
                'Event', 
                $data['event_data']
            );
        }
        
        if($problem){
            return $problem;
        }
        
        //odd_data
        if(isset($data['odd_data'])) {
            $problem = $this->validateAndCreate(
                'Odd', 
                $data['odd_data']
            );
        }
        
        if($problem){
            return $problem;
        }
        
        //odd_selection_data MUST BE array of with an array of odds
        if(isset($data['odd_selection_data'])) {
            if(is_array($data['odd_selection_data'])){
                foreach($data['odd_selection_data'] as $key => $val) {
                    
                    if(!is_array($val)){
                        $this->validationResponse->data[] = 'odd_selection_data must be an array of odd selections';
                        return $this->validationResponse;
                    }
                    $problem = $this->validateAndCreate(
                        'OddSelection', 
                        $val
                    );
                    
                    if($problem){
                        return $problem;
                    }
                }
            } else {
                $this->validationResponse->data[] = 'odd_selection_data must be an array';
                return $this->validationResponse;
            }
        }
        
        return false;
    }
    
    private function validateAndCreate($controller, $data)
    {
        $c = 'RiskMan\\V1\\Rest\\'. $controller . '\\Validator';
        //level 1 validation
        foreach($data as $name => $value) {
            //filter value
            $fval = $this->filterField($c, $name, $value);
            //validate
            $problem = $this->validateReqField($c, $name, $fval);
            if($problem){
                return $problem;
            }
        }
        //level 2 validation and creation
        $o = [];
        $field_name = '';
        if($controller == 'Event') {
            $o = $this->de;
            $field_name = 'event';
        } elseif ($controller == 'Odd') {
            $o = $this->do;
            $field_name = 'odd';
        } elseif ($controller == 'OddSelection') {
            $o = $this->dos;
            $field_name = 'odd_selection';
        }
        $problem = $o->create((object)$data);
        if($problem->code != 200) {
            return $problem;
        }
         
        return false;
    }
    
    private function filterAndValidate($controller, $name, $value)
    {
        //filter value
        $fval = $this->filterField($controller, $name, $value);
        //validate
        $problem = $this->validateReqField($controller, $name, $fval);
        if($problem){
            return $problem;
        }
        return false;
    }
    
    
    
    private function filterField($controller, $name, $value)
    {
        $vtemp = $value;
        $specs = $this->getFilterSpecs($controller, $name);
        foreach($specs as $key => $filter) {
            $f = new $filter['name']('', $filter['options']);
            $vtemp = $f->filter($vtemp);
        }
        return $vtemp;
    }
    
    private function getFilterSpecs($controller, $name)
    {
        $config = $this->sm->get('config');
        $input_specs = $config['input_filter_specs'];
        $cSpecs = [];
        if(isset($input_specs[$controller])){
            //check if field name exist
            $cSpecs = $input_specs[$controller];
            foreach($cSpecs as $key => $field) {
                if($field['name'] == $name && isset($field['filters'])) {
                    return $field['filters'];
                }
            }
        } else {
            return false;
        }
    }
    
    private function getValidatorSpecs($controller, $name)
    {
        $config = $this->sm->get('config');
        $input_specs = $config['input_filter_specs'];
        $cSpecs = [];
        if(isset($input_specs[$controller])){
            //check if field name exist
            $cSpecs = $input_specs[$controller];
            foreach($cSpecs as $key => $field) {
                if($field['name'] == $name) {
                    return $field;
                }
            }
        } else {
            return false;
        }
    }
    
    private function validateReqField($controller, $name, $value)
    {
        $specs = $this->getValidatorSpecs($controller, $name);
        $valVals = $specs['validators'];
        foreach($valVals as $key => $validator) {
            $v = new $validator['name']();
            $v->setOptions($validator['options']);
            $valid = $v->isValid($value);
            if(!$valid){
                $this->validationResponse->data['validation_messages'] = $v->getMessages();
                return $this->validationResponse;
            }
        }
        return false;
    }
    
    
}

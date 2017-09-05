<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain;

/**
 * Description of DomainObject
 *
 * @author rolf
 */
class DomainObject 
{
    protected $bookId;
    protected $fields;
    protected $data;
    
    public function setFields($fields)
    {
        if(is_array($fields) && sizeof($fields) > 0) {
            $this->fields = $fields;
            return $this;
        }
        return false;
    }
   
    public function validateFields($data = null, $fields = null) 
    {
        $problem = [
                'code' => 422,
                'type' => 'ValidationError',
                'title' => 'InvalidData',
                'details' => 'Field received not found part of this endpoint.',
                'data' => [
                    'field_name' => ''
            ]
        ];
        //if fields not set return invalid
        $this->setFields($fields);
        if (null === $this->fields) {
            $problem['details'] = 'Error';
            $problem['data']['error'] = 'Fields not set, Please contact Support';
            return $problem;
        }
        
        foreach($data as $key => $value) {
            //validate level 1 fields
            $count = 0;
            foreach ($this->fields as $fkey => $fvalue) {
                if($key == $fvalue) {   
                    $count++;
                }
            }
            if($count <= 0) {
                $problem['data']['field_name'] = $key;
                return $problem;
            }
        }
        
        //default return  invalid
        return false;
    }
    
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
        return $this;
    }
    
    public function getBookId()
    {
        return $this->bookId;
    }
    
    public function setModelsBookId(array $models)
    {
        foreach($models as $model) {
            $model->setBookId($this->bookId);
        }
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain;

/**
 * Description of DomainResponse
 *
 * @author rolf
 */
class DomainResponse 
{
    public $code;
    public $type;
    public $title;
    public $details;
    public $data;
    
    public function __construct(array $data) 
    {
        $this->code = isset($data['code']) ? $data['code'] : 500;
        $this->type = isset($data['type']) ? $data['type'] : 'undefined';
        $this->title = isset($data['title']) ? $data['title'] : 'undefined';
        $this->details = isset($data['details']) ? $data['details'] : 'undefined';
        $this->data = isset($data['data']) ? $data['data'] : [];
    }
}

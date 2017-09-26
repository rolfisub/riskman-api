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
        $this->code = $data['code'] ? $data['code'] : 500;
        $this->type = $data['type'] ? $data['type'] : 'undefined';
        $this->title = $data['title'] ? $data['title'] : 'undefined';
        $this->details = $data['details'] ? $data['details'] : 'undefined';
        $this->data = $data['data'] ? $data['data'] : [];
    }
}

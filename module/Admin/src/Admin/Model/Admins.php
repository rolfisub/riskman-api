<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Model;

use Admin\Mapper\AdminsMapper;
/**
 * Description of Admins
 *
 * @author rolf
 */
class Admins 
{
    protected $mapper;
    
    public function __construct(AdminsMapper $mapper) 
    {
        $this->mapper = $mapper;
    }
    
    public function getAdminsData()
    {
        return $this->mapper->getAdminsData();
    }
    
    public function createAdmin($data)
    {
        return $this->mapper->createAdmin($data);
    }
    
}

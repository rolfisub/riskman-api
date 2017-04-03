<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Entity;

use Admin\Entity\AbstractEntity;
/**
 * Description of Admin
 *
 * @author rolf
 */
class Admin extends AbstractEntity
{
    public function __construct($data) 
    {
        $this->setCreateReqFields([
            'username',
            'password',
            'email',
            'firstname',
            'lastname'
        ])->setCreateOptFields([
            //none
        ]);
        parent::__construct($data);
    }
    
    
    
    
}

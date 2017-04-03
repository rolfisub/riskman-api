<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Mapper;

use Admin\Mapper\AbstractMapper;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression as SqlExpression;

use Admin\Error\Error400;

/**
 * Description of StatsMapper
 *
 * @author rolf
 */
class AdminsMapper extends AbstractMapper
{
    
    
    public function getAdminsData()
    {
        return [
            'admins_data' => $this->_getAdminsData(),
        ];
    }
    
    /**
     * gets the amount of successful requests
     * @return array
     */
    private function _getAdminsData()
    {
        $s = new Select();
        $s->from(['a'=>'admins'])
            ->columns([
                'user_name',
                'datetime'
            ])
            ->join(
                ['ai'=>'admins_info'],
                'a.id = ai.id',
                [
                    'email',
                    'first_name',
                    'last_name'
                    ]
                    
            );   
        $result = $this->queryObject($s);
        $data = $result->toArray();
        return $data;
    }
    
    public function createAdmin($data)
    {
        
    }
    
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BookOptions;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;
/**
 * Description of Mapper
 *
 * @author rolf
 */
class Mapper 
{
    protected $adapter;
    protected $sql;
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->sql = new Sql($this->adapter);
    }
    
    protected function getArrayFrom($o) 
    {
        $stmt = $this->sql->prepareStatementForSqlObject($o);
        $results = $stmt->execute();
        $result_set = new ResultSet();
        $result_set->initialize($results);
        $arr = $result_set->toArray();
        if (sizeof($arr) > 0) {
            return $arr;
        }
        return false;
    }
    
    public function getOptions($book_id)
    {
        $s = $this->sql->select();
        $s->from([
            'bs' => 'books'
        ])->columns([
            'name',
            'enabled'
        ])->join([
            'bf' => 'book_format'
        ], 
            'bs.id = bf.book_id',
            [
                'odd_format',
                'time_zone',
                'currency'
            ]
        )->join([
            'bc' => 'book_centline'
        ], 
            'bs.id = bc.book_id',
            [
                'centline'
            ]
        )->join([
            'br' => 'book_ranking'
        ], 
            'bs.id = br.book_id',
            [
                'rankings'
            ]
        )->where([
            'bs.id' => $book_id
        ]);
        
        return $this->getArrayFrom($s);
        
    }
}

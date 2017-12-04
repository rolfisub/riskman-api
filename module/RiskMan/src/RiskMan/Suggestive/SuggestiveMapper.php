<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Suggestive;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
/**
 * Description of SuggestiveMapper
 *
 * @author rolf
 */
class SuggestiveMapper
{
    private $adapter;
    private $sql;
    
    public function __construct(Adapter $a) {
        $this->adapter = $a;
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
}

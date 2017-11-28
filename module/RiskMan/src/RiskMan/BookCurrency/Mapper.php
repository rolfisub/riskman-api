<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BookCurrency;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;
/**
 * Description of BookCurrencyMapper
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
    
    
    public function getUSDRate($currency)
    {
        $s = $this->sql->select('exchange_rates');
        $s->columns([
            'rate'
        ]);
        $s->where([
            'code' => $currency
        ]);
        return $this->getArrayFrom($s);
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

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Model;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;

/**
 * Description of ModelObject
 *
 * @author rolf
 */
class ModelObject 
{
    
    protected $za;
    protected $sql;
    protected $table;
    protected $name;
    protected $where;
    
    public function __construct(Adapter $za, $table, $name, $bookId)
    {
        if(null === $this->za){
            $this->za = $za;
            $this->sql = new Sql($this->za);       
        }
        if(null === $this->table){
            $this->table = $table;
        }
        if(null === $this->name){
            $this->name = $name;
        }
        if(null === $this->where){
            $this->where = [
                'book_id' => $bookId
            ];
        }
        $this->sql->setTable($this->table);
    }
    
    public function create($data)
    {
        $i = $this->sql->insert();
        $data['book_id'] = $this->where['book_id'];
        $i->values($data);
        return $this->exec($i)->getGeneratedValue();
    }
    
    public function read($id)
    {
        $r = $this->sql->select();
        $this->where[$this->name . '_id'] = $id;
        $r->where($this->where);
        $r->limit(1);
        $result = $this->getArrayFrom($r);
        if(isset($result[0])){
            return $result[0];
        } else {
            return false;
        }
    }
    
    public function readInternalId($id)
    {
        $r = $this->sql->select();
        $this->where['id'] = $id;
        $r->where($this->where);
        $r->limit(1);
        $result = $this->getArrayFrom($r);
        if(isset($result[0])){
            return $result[0];
        } else {
            return false;
        }
    }
    
    public function update($id, $data, $where = null)
    {
        $u = $this->sql->update();
        $u->set($data);
        $this->where[$this->name . '_id'] = $id;
        if (is_array($where)) {
            $w = array_merge($where, $this->where);
            $u->where($w);
        } else {
            $u->where($this->where);
        }
        return $this->exec($u);
    }
    
    public function delete ($id, $where = null)
    {
        $d = $this->sql->delete();
        $this->where[$this->name . '_id'] = $id;
        $d->where($this->where);
        if (is_array($where)) {
            $w = array_merge($where, $this->where);
            $d->where($w);
        } else {
            $d->where($this->where);
        }
        return $this->exec($d);
    }
    
    protected function exec ($o)
    {
        $stmt = $this->sql->prepareStatementForSqlObject($o);
        $r = $stmt->execute();
        return $r;
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

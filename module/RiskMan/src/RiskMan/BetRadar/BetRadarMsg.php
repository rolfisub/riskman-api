<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BetRadar;

use RiskMan\BetRadar\Mapper\BetRadarMsg as MsgMapper;
use RiskMan\Domain\DomainObject;
/**
 * Description of BetRadarMsg
 *
 * @author rolf
 */
class BetRadarMsg extends DomainObject
{

    protected $mapper;
    
    
    public function __construct(MsgMapper $mapper)
    {
        $this->mapper = $mapper;
        $this->setFields([
            'msg_id',
            'msg'
        ]);
    }
    
    public function createMsg($data)
    {
        $this->setModelsBookId([$this->mapper]);
        
        $problem = $this->validateFields($data);
        if($problem) {
            return $problem;
        }
        
        $id = $data->msg_id;
        $sqlArr = $this->toSqlArray($data);
        $m = $this->mapper->read($id);
        if ($m){
            //update event
            $this->mapper->update($id, $sqlArr);
        } else {
            //create event
            $this->mapper->create($sqlArr);
        }
        return [
            'code' => 200,
            'type' => 'OK',
            'title' => 'Success',
            'details' => 'Msg succesfully created or updated.',
            'data' => $this->returnMsgArray($id)
        ];
        
    }
    
    private function toSqlArray($data)
    {
        $arr = [];
        if ($data->msg_id){
            $arr['msg_id'] = $data->msg_id;
        }
        if ($data->msg) {
            $arr['msg'] = $data->msg;
        }
        return $arr;
    }
    
    private function returnMsgArray($id)
    {
        $m = $this->mapper->read($id);
        $a = [];
        if($m) {
            $a = $m;
            //delete private data
            if(isset($a['id'])) {
                unset($a['id']);
            }
            if(isset($a['book_id'])) {
                unset($a['book_id']);
            }
            if(isset($a['datetime'])) {
                unset($a['datetime']);
            }
            return $a;
        }
        return false;
    }
}

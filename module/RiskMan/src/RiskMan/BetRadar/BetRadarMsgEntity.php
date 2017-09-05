<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BetRadar;

/**
 * Description of BetRadarMsgEntity
 *
 * @author rolf
 */
class BetRadarMsgEntity 
{
    public $betradarmsg_id;
    public $msg;
    public $xml;
    
    public function __construct($input) 
    {
        $this->betradarmsg_id = $input->betradarmsg_id;
        $this->msg = $input->msg;
        try {
            $this->xml = new \SimpleXMLElement($this->msg);
        }
        catch (\Exception $e) {
            $this->xml = false;
        };
    }
}

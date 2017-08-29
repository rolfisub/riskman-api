<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BetRadar;

/**
 * Description of BetRadarMsg
 *
 * @author rolf
 */
class BetRadarMsg 
{
    protected $msg_id;
    protected $msg;
    protected $xml;
    
    /**
     * @param string $input XML String from Bet Radar
     */
    public function __construct($input)
    {
        $this->msg_id = $input->msg_id;
        $this->msg = $input->data;
       // $this->xml = new \SimpleXMLElement($this->msg);
    }
}

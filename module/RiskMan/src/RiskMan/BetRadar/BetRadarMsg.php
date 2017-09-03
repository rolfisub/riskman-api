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
    public $book_id;
    public $msg_id;
    public $msg;
    public $xml;
    
    /**
     * @param string $input XML String from Bet Radar
     */
    public function __construct($input, $bookId)
    {
        $this->book_id = $bookId;
        $this->msg_id = $input->msg_id;
        $this->msg = $input->data;
        try {
            $this->xml = new \SimpleXMLElement($this->msg);
        }
        catch (\Exception $e) {
            $this->xml = false;
        }
    }
    
    
    public function toArray()
    {
        return [
            'msg_id' => $this->msg_id,
            'msg' => $this->msg
        ];
    }
}

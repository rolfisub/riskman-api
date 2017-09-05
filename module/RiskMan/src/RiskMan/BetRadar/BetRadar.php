<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BetRadar;

use RiskMan\BetRadar\Config;
use RiskMan\BetRadar\BetRadarMsg;
use RiskMan\Domain\Feed\Event;
use RiskMan\BetRadar\RadarMsgParser;

/**
 * Description of BetRadar
 *
 * @author rolf
 */
class BetRadar 
{
    /**
     * @access protected
     * 
     */
    protected $msg;
    
    protected $config;
    
    protected $bookId;
    
    protected $event;
    
    protected $radarMsg;
    
    protected $parser;
    
    
    
    /**
     * Constructor
     * @param  Config $config Configuration for specific Bet radar Feed 
     * @param BetRadarMsg $msgMapper Description
     * @param Event $eventModel Description
     */
    public function __construct(Config $config, Event $eventModel, BetRadarMsg $radarMsg, RadarMsgParser $parser) 
    {
        $this->config = $config;
        $this->event = $eventModel;
        $this->radarMsg = $radarMsg;
        $this->parser = $parser;
    }
    
    
    /**
     * Public API
     * main entry point
     */
    public function processMsg($input)
    {
        $response = [
            'status' => 404,
            'title' => '',
            'detail'=> '',
            'type'=> '',
            'additional' => []
        ];        
        //save msg to msg table
        $problem = $this->radarMsg->createMsg($input);
        if($problem['code'] !== 200) {
            return [
                'status' => $problem['code'],
                'title' => $problem['title'],
                'details' => $problem['details'],
                'additional' => $problem['data'],
                'type' => $problem['type']
            ];
        }
        //helper to initialize parser
        $this->parser->init($input);
        
        $events = $this->parser->getEvents();
        
        //create events
        foreach($events as $key => $event) {
            $problem2 = $this->event->create((object)$event);
            if($problem2['code'] !== 200) {
               return [
                    'status' => $problem2['code'],
                    'title' => $problem2['title'],
                    'details' => $problem2['details'],
                    'additional' => $problem2['data'],
                    'type' => $problem2['type']
                ]; 
            }
        }
        
        //create odds
        
        //create odds selections
        
        //create futures
        
        
        /**
         * end
         */
        $response['status'] = 200;
        $response['type'] = 'OK';
        $response['title'] = 'Success.';
        $response['detail'] = 'BetRadar msg processed and saved.';
        $response['additional']['betradarmsg_id'] = $input->betradarmsg_id;
        return $response;
    }
    
    
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
        $this->event->setBookId($this->bookId);
        $this->radarMsg->setBookId($this->bookId);
        return $this;
    }
    
}

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
use RiskMan\Domain\Feed\Odd;
use RiskMan\Domain\Feed\OddSelection;
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
    
    protected $odd;
    
    protected $oddselection;
    
    protected $radarMsg;
    
    protected $parser;
    
    
    
    /**
     * Constructor
     * @param  Config $config Configuration for specific Bet radar Feed 
     * @param BetRadarMsg $msgMapper Description
     * @param Event $eventModel Description
     */
    public function __construct(
            Config $config, 
            Event $eventModel,
            Odd $odd,
            OddSelection $oddsel,
            BetRadarMsg $radarMsg, 
            RadarMsgParser $parser) 
    {
        $this->config = $config;
        $this->event = $eventModel;
        $this->odd = $odd;
        $this->oddselection = $oddsel;
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
        $odds = $this->parser->getOdds();
        
        foreach($odds as $key2 => $odd) {
            $problem3 = $this->odd->create((object) $odd);
            if($problem3['code'] !== 200) {
               return [
                    'status' => $problem3['code'],
                    'title' => $problem3['title'],
                    'details' => $problem3['details'],
                    'additional' => [$problem3['data']],
                    'type' => $problem3['type']
                ]; 
            }
        }
        
        //create odds selections
        $oddselections = $this->parser->getOddSelections();
        
        foreach($oddselections as $key3 => $oddsel) {
            $problem4 = $this->oddselection->create((object) $oddsel);
            if($problem4['code'] !== 200) {
               return [
                    'status' => $problem4['code'],
                    'title' => $problem4['title'],
                    'details' => $problem4['details'],
                    'additional' => [$problem4['data']],
                    'type' => $problem4['type']
                ]; 
            }
        }
        //create futures
        
        
        /**
         * end
         */
        $response['status'] = 200;
        $response['type'] = 'OK';
        $response['title'] = 'Success.';
        $response['detail'] = 'BetRadar msg processed and saved.';
        $response['additional']['betradarmsg_id'] = $input->betradarmsg_id;
        $response['additional']['stats'] = [
            'events' => sizeof($events),
            'odds' => sizeof($odds),
            'odds_selections' => sizeof($oddselections)
        ];
        return $response;
    }
    
    
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
        $this->event->setBookId($this->bookId);
        $this->radarMsg->setBookId($this->bookId);
        $this->odd->setBookId($this->bookId);
        $this->oddselection->setBookId($this->bookId);
        return $this;
    }
    
}

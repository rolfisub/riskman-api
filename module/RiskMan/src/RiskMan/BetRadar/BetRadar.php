<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BetRadar;

use RiskMan\BetRadar\Config;
use RiskMan\BetRadar\Mapper\BetRadarMsg as Mapper;
use RiskMan\BetRadar\BetRadarMsg;

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
    
    protected $mapper;
    
    protected $config;
    
    protected $bookId;
    
    protected $lang;
    
    protected $langKey;
    
    
    
    /**
     * Constructor
     * @param  Config $config Configuration for specific Bet radar Feed 
     * @param BetRadarMsg $msgMapper Description
     */
    public function __construct(Config $config, Mapper $msgMapper) 
    {
        $this->config = $config;
        $this->mapper = $msgMapper;
        $this->lang = 'en';
        $this->langKey = 0;
    }
    
    
    /**
     * Public API
     */
    public function createMsg(BetRadarMsg $msg, $bookId)
    {
        $response = [
            'status' => 404,
            'title' => '',
            'detail'=> '',
            'type'=> '',
            'additional' => []
        ];
        if($msg->xml === false) {
            $response['status'] = 404;
            $response['title'] = 'Validation Error.';
            $response['detail'] = 'Malformed XML Document';
            return $response;
        }
        
        $this->setMsg($msg);
        $this->setBookId($bookId);
        
        //save msg
        $this->mapper->create($this->getMsg()->toArray());
        
        /**
         * process msg here
         */
        $this->updateFeed();
        
        var_dump($this->msg->xml);die();
        /**
         * end
         */
        $response['status'] = 200;
        $response['title'] = 'Success.';
        $response['detail'] = 'BetRadar msg processed and saved.';
        return $response;
    }
    
    private function updateFeed()
    {
        $xml = $this->msg->xml;
        $sports = $xml->Sports;
        $eventData = [
            'event_id' => '',
            'event_name' => '',
            'sport_id' => '',
            'sport_name' => '',
            'region_id' => '',
            'region_name' => '',
            'league_id' => '',
            'league_name' => '',
            'datetime' => ''
        ];
        foreach($sports->Sport as $key1 => $sport) {
            $eventData['sport_id'] = (string)$sport["BetradarSportID"];
            $this->getLangKey($sport->Texts);
            $eventData['sport_name'] = (string)$sport->Texts->Text[$this->langKey]->Value;
            $categories = $sport->Category;
            foreach($categories as $key2 => $category) {
                $eventData['region_id'] = (string)$category['BetradarCategoryID'];
                $eventData['region_name'] = (string)$category->Texts->Text[$this->langKey]->Value;
                $leagues = $category->Tournament;
                foreach($leagues as $key3 => $league) {
                    $eventData['league_id'] = (string)$league['BetradarTournamentID'];
                    $eventData['league_name'] = (string)$league->Texts->Text[$this->langKey]->Value;
                    $events = $league->Match;
                    foreach($events as $key4 => $event) {
                        $eventData['event_id'] = (string)$event['BetradarMatchID'];
                        $eventData['datetime'] = (string)$event->Fixture->DateInfo->MatchDate;
                        $competitorCount = sizeof($event->Fixture->Competitors->Texts);
                        if($competitorCount === 2) {
                            $competitor1 = $event->Fixture->Competitors->Texts[0];
                            $competitor2 = $event->Fixture->Competitors->Texts[1];
                            $t1 = (string)$competitor1->Text->Text[$this->langKey]->Value;
                            $t2 = (string)$competitor2->Text->Text[$this->langKey]->Value;
                            $eventData['event_name'] = $t1 . ' vs ' . $t2;
                        }
                        else {
                            die('more than 2 competitors found');
                        }
                        var_dump($eventData);
                    }
                }
            }
        }
        die();
    }
    
    private function getLangKey($texts)
    {
        $langKey = -1;
        $count = 0;
        foreach($texts->Text as $key => $text) {
            if((string)$text['Language'] == $this->lang) {
                $langKey = $count;
            }
            $count++;
        }
        $this->langKey = $langKey;
        return $this->langKey;
    }
    
    
    
    /**
     * Setters and Getters
     */
    public function setMsg(BetRadarMsg $msg)
    {
        $this->msg = $msg;
        return $this;
    }
    
    public function getMsg()
    {
        return $this->msg;
    }
    
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
        $this->mapper->setBookId($this->bookId);
        return $this;
    }
    
    public function getBookId()
    {
        return $this->bookId;
    }
    
}

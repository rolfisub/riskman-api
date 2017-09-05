<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BetRadar;

use RiskMan\BetRadar\BetRadarMsgEntity;
/**
 * Description of RadarMsgParser
 *
 * @author rolf
 */
class RadarMsgParser 
{
    protected $m;
    
    protected $lang;
    
    protected $langKey;
    
    public function __construct() 
    {
        $this->lang = 'en';
        $this->langKey = 0;
    }
    
    public function init($input)
    {
        $m = new BetRadarMsgEntity($input);
        $this->setMsg($m);
    }
    
    public function setMsg(BetRadarMsgEntity $msg)
    {
        $this->m = $msg;
    }
    /**
     * Returns an array of events to be processed by the domain object
     * @return array array of event objects
     */
    public function getEvents()
    {
        if($this->m === null) {
            return false;
        }
        $events = [];
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
        $xml = $this->m->xml;
        $sports = $xml->Sports;
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
                            die('Error more than 2 competitors found');
                        }
                        $events[] = $eventData;
                    }
                }
            }
        }
        
        return $events;
        
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
    
    
}

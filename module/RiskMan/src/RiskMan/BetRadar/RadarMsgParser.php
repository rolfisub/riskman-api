<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\BetRadar;

use RiskMan\BetRadar\BetRadarMsgEntity;
use RiskMan\Domain\DomainResponse;
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
    
    public function getMsg()
    {
        return $this->m;
    }
    
    
    /**
     * Returns array of event odds selections
     * @return array
     */
    public function getOddSelections() 
    {
        if($this->m === null) {
            return false;
        }
        $oddsReturn = [];
        $oddsData = [
            'odd_selection_id' => '',
            'odd_selection_name' => '',
            'odd_id' => '',
            'event_id' => '',
            'points' => null,
            'odd' => ''
        ];
        $xml = $this->m->xml;
        $sports = $xml->Sports;
        foreach($sports->Sport as $key1 => $sport) {
            $this->getLangKey($sport->Texts);
            $categories = $sport->Category;
            foreach($categories as $key2 => $category) {
                $leagues = $category->Tournament;
                foreach($leagues as $key3 => $league) {
                    $events = $league->Match;
                    foreach($events as $key4 => $event) {
                        $oddsData['event_id'] = (string)$event['BetradarMatchID'];
                        $odds = $event->MatchOdds->Bet;
                        if(is_array($odds)) {
                            foreach($odds as $key5 => $bet) {
                                $oddsData['odd_id'] = $oddsData['event_id'] . '.' . $bet['OddsType'];
                                $odds = $bet->Odds;
                                foreach($odds as $key6 => $odd){
                                    if(isset($odd['OutComeId'])) {
                                        $oddsData['odd_selection_id'] = (string) $odd['OutComeId'];
                                    } else {
                                        $oddsData['odd_selection_id'] = (string) $odd['OutCome'];
                                    }
                                    $oddsData['odd_selection_name'] = (string) $odd['OutCome'];
                                    if(isset($odd['SpecialBetValue'])){
                                        $oddsData['points'] = (int) $odd['SpecialBetValue'];
                                    }
                                    $oddsData['odd'] = (double) $odd;
                                    if($oddsData['odd']) {
                                        $oddsReturn[] = $oddsData;
                                    }
                                }
                            }
                        }
                        
                    }
                }
            }
        }
        return $oddsReturn;
    }
    
    /**
     * 
     * @param array $data
     */
    public function updateMsgOddSelectionData(DomainResponse $res)
    {
        $data = $res->data;
        $xml = $this->m->xml;
        $sports = $xml->Sports;
        foreach($sports->Sport as $key1 => $sport) {
            $this->getLangKey($sport->Texts);
            $categories = $sport->Category;
            foreach($categories as $key2 => $category) {
                $leagues = $category->Tournament;
                foreach($leagues as $key3 => $league) {
                    $events = $league->Match;
                    foreach($events as $key4 => $event) {
                        if($data['event_id'] == (string)$event['BetradarMatchID']) {
                            $odds = $event->MatchOdds->Bet;
                            if(is_array($odds)){
                                foreach($odds as $key5 => $bet) {
                                    if($data['odd_id'] == $data['event_id'] . '.' . $bet['OddsType']) {

                                        $odds = $bet->Odds;
                                        foreach($odds as $key6 => $odd){
                                            $odd_sel_id = '';
                                            if(isset($odd['OutComeId'])) {
                                                $odd_sel_id = (string) $odd['OutComeId'];
                                            } else {
                                                $odd_sel_id = (string) $odd['OutCome'];
                                            }

                                            if($data['odd_selection_id'] == $odd_sel_id) {
                                                if(isset($odd['SpecialBetValue'])){
                                                    $odd['SpecialBetValue'] = $data['points'];
                                                }
                                                $odd[0] = number_format($data['odd'], 4, '.', '');
                                            }

                                        }

                                    }
                                }
                            }
                        }
                        
                    }
                }
            }
        }
        
    }
    
    public function getXMLString()
    {
        return $this->m->updateXMLString();
    }


    /**
     * Returns array of event odds
     * @return array
     */
    public function getOdds() 
    {
        if($this->m === null) {
            return false;
        }
        $oddsReturn = [];
        $oddsData = [
            'odd_id' => '',
            'odd_name' => '',
            'event_id' => '',
            'datetime' => ''
        ];
        $xml = $this->m->xml;
        $sports = $xml->Sports;
        foreach($sports->Sport as $key1 => $sport) {
            $this->getLangKey($sport->Texts);
            $categories = $sport->Category;
            foreach($categories as $key2 => $category) {
                $leagues = $category->Tournament;
                foreach($leagues as $key3 => $league) {
                    $events = $league->Match;
                    foreach($events as $key4 => $event) {
                        $oddsData['event_id'] = (string)$event['BetradarMatchID'];
                        $oddsData['datetime'] = (string)$event->Fixture->DateInfo->MatchDate;
                        $odds = $event->MatchOdds->Bet;
                        if(is_array($odds)) {
                            foreach($odds as $key5 => $odd) {
                                $oddsData['odd_id'] = $oddsData['event_id'] . '.' . $odd['OddsType'];
                                $oddsData['odd_name'] = $oddsData['odd_id'];
                                $oddsReturn[] = $oddsData;
                            }
                        }
                        
                    }
                }
            }
        }
        return $oddsReturn;
        
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
        $eventsReturn = [];
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
                        $eventsReturn[] = $eventData;
                    }
                }
            }
        }
        return $eventsReturn;
        
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

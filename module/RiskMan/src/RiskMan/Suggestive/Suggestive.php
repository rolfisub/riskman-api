<?php

namespace RiskMan\Suggestive;

use RiskMan\Suggestive\SuggestiveMapper;
use RiskMan\Suggestive\Entity\Suggestion\OddSuggestion;
use RiskMan\Suggestive\Entity\Feed\OddSelection;
use RiskMan\Suggestive\Entity\Bets\Single;
use RiskMan\Suggestive\Entity\Bets\Multiple;
/**
 * Suggestive class will be used as a base class for storing common methods
 *
 * @author rolf
 */
class Suggestive 
{
    private $mapper;
    
    public function __construct(SuggestiveMapper $sm) {
        $this->mapper = $sm;
    }
    
    /**
     * gets an odds suggestion from a feed event
     * @return OddSuggestion Description
     * @param OddSelection $os
     */
    public function getFeedSuggestion(OddSelection $os)
    {
        die("entry point for feed suggestion");
    }
    
    /**
     * returns odd suggestion from a single event bet
     * @return OddSuggestion Description
     * @param Single $s
     */
    public function getSingleSuggestion(Single $s)
    {
        
    }
    
    /**
     * returns oddsugestion based of multiple event bet
     * @return OddSuggestion Description
     * @param Multiple $m
     */
    public function getMultipleSuggestion(Multiple $m)
    {
        
    }
}

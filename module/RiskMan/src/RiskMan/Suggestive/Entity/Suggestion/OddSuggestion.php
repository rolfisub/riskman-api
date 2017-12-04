<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Suggestive\Entity\Suggestion;

use RiskMan\Suggestive\Entity\Suggestion\Limit;
use RiskMan\Suggestive\Entity\Bets\Single;
use RiskMan\Suggestive\Entity\Bets\Multiple;

/**
 * Description of OddSuggestion
 *
 * @author rolf
 */
class OddSuggestion 
{
    /**
     * Odd ID
     * @var string 
     */
    public $odd_id;
    /**
     * Sum of all bets risk for this Odd
     * @var double 
     */
    public $total_risk;
    /**
     * Ranking
     * @var string
     */
    public $ranking;
    /**
     * Amount max expected for this ranking level
     * @var double
     */
    public $max_expected;
    /**
     * Current centline based of favorite selection
     * @var double
     */
    public $centline;
    /**
     * Limits for a bet, min and max
     * @var Limit
     */
    public $bet_limit;
    
    /**
     * Odd selections for a bet
     * @var array of OddSelection
     */
    public $odd_selections = [];
    
    
}

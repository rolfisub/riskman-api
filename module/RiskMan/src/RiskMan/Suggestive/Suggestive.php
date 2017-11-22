<?php

namespace RiskMan\Suggestive;

use RiskMan\Suggestive\SuggestiveMapper;
use RiskMan\Suggestive\Entity\OddSuggestion;
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
     * Generated suggestion after bet
     * @var OddSuggestion
     */
    protected $new;
    
    /**
     * This function generates the new suggestion
     */
    public function getNew($odd_id, $odd_selection_id, $risk)
    {
        if(!$this->new) {
            $this->new = new OddSuggestion();
        }
        return $this->new;
    }
}

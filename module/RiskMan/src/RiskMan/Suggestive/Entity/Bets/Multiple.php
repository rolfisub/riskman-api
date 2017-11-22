<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Suggestive\Entity\Bets;

/**
 * Description of Multiple
 *
 * @author rolf
 */
class Multiple 
{
    /**
     * Book ID
     * @var int
     */
    public $book_id;
    /**
     * Multiple ID
     * @var string
     */
    public $multiple_id;
    /**
     * Risk amount
     * @var double
     */
    public $risk;
    /**
     * Win amount
     * @var double
     */
    public $win;
    /**
     * Total payout
     * @var double
     */
    public $payout;
    /**
     * Odd Selections
     */
    public $odd_selections = [];
}

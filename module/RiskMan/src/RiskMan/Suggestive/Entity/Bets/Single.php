<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Suggestive\Entity\Bets;

use RiskMan\Suggestive\Entity\OddSelection;
/**
 * Description of Single
 *
 * @author rolf
 */
class Single 
{
    /**
     * Book ID
     * @var int
     */
    public $book_id;
    /**
     * Single ID
     * @var string
     */
    public $single_id;
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
     * Odd Selection ID
     * @var OddSelection 
     */
    public $odd_selection;
}

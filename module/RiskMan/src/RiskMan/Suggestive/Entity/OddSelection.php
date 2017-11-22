<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Suggestive\Entity;

/**
 * Description of OddSelection
 *
 * @author rolf
 */
class OddSelection 
{
    /**
     * Book ID
     * @var int
     */
    public $book_id;
    /**
     * Odd ID
     * @var string
     */
    public $odd_id;
    /**
     * Odd selection ID
     * @var string
     */
    public $odd_selection_id;
    /**
     * Sum of all Risk on this Selection
     * @var double
     */
    public $risk_total;
    /**
     * Odd
     * @var type 
     */
    public $odd;
}

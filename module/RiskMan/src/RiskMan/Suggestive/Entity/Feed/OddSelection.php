<?php

/**
 * @package   RiskMan API 
 * @author    Rolf
 * @copyright Copyright 2017 Rolfitech, Inc.
 */

namespace RiskMan\Suggestive\Entity\Feed;

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
     * Odd
     * @var type 
     */
    public $odd;
}

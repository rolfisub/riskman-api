<?php
namespace RiskMan\BookOptions\Entity;

/**
 * Description of Options
 *
 * @author rolf
 */
class Options 
{
    public function __construct($book_id, array $data) 
    {
        $this->book_id = $book_id;
        $this->enabled = $data['enabled'];
        $this->odd_format = $data['odd_format'];
        $this->time_zone = $data['time_zone'];
        $this->currency = $data['currency'];
        $this->centline = json_decode($data['centline']);
        $this->rankings = json_decode($data['rankings']);
    }
    
    
    
    /*
     * here are all the options of a book
     */
    
    public $book_id;
    
    public $enabled;
    
    public $odd_format;
    
    public $time_zone;
    
    public $currency;
    
    public $centline;
    
    public $rankings;
    
}

<?php
namespace RiskMan\BookOptions;

use RiskMan\BookOptions\Mapper as OptionsMapper;
use RiskMan\BookOptions\Entity\Options;
/**
 * Description of BookOptions
 * this class will read current options and assign it to object properties to be accessed by the engine
 *
 * @author rolf
 */
class BookOptions 
{
    protected $mapper;
    
    public function __construct(OptionsMapper $mapper) {
        $this->mapper = $mapper;
    }
    
    /**
     * Gets book options
     * @param int $bookId
     * @return Options
     */
    public function getOptions($book_id)
    {
        $data = $this->mapper->getOptions($book_id);
        if(is_array($data[0])) {
            return new Options($book_id, $data[0]);
        }
        return false;
    }
}

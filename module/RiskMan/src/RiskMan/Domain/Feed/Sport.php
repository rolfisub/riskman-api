<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use RiskMan\Domain\Feed\DomainFeedObject;
use RiskMan\Model\Feed\Sport as MSport;


/**
 * Description of Sport
 *
 * @author rolf
 */
class Sport extends DomainFeedObject
{
    /*
     * @var RiskMan\Model\Feed\Sport
     */
    protected $s;
    
    /*
     * constructor TODO: Annotations
     */
    public function __construct(MSport $s) {
        $this->s = $s;
    }
    
    //POST
    public function create($data, $bookId)
    {
        $sportId = $data->sport_id;
        $s = $this->s->getSport($sportId, $bookId); 
        if (!$s) {
            //create new sport
            echo "creating new sport\n";
            $s = $this->s->newSport($data, $bookId);
        } else {
            //sport exist
            echo "existing sport\n";
            //$s = $this->update($data, $bookId, $s);
        }
        return $s;
    }
    
    
    
    
}

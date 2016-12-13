<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use RiskMan\Domain\Feed\DomainFeedObject;
use RiskMan\Model\Feed\League as MLeague;


/**
 * Description of League
 *
 * @author rolf
 */
class League extends DomainFeedObject
{
    /*
     * @var RiskMan\Entity\Feed\League
     */
    protected $l;
    
    /*
     * constructor TODO: Annotations
     */
    public function __construct(MLeague $l) {
        $this->l = $l;
    }
    
    //POST
    public function create($data, $bookId)
    {
        $leagueId = $data->league_id;
        $l = $this->l->getLeague($leagueId, $bookId); 
        if (!$l) {
            //create new league
            echo "creating new league\n";
            $l = $this->l->newLeague($data, $bookId);
        } else {
            //league exist
            echo "existing league\n";
            //$l = $this->update($data, $bookId, $l);
        }
        return $l;
    }
}

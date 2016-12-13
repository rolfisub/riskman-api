<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use RiskMan\Domain\Feed\DomainFeedObject;
use RiskMan\Model\Feed\Region as MRegion;


/**
 * Description of Region
 *
 * @author rolf
 */
class Region extends DomainFeedObject
{
    /*
     * @var RiskMan\Entity\Feed\Region
     */
    protected $r;
    
    /*
     * constructor TODO: Annotations
     */
    public function __construct(MRegion $r) {
        $this->r = $r;
    }
    
    //POST
    public function create($data, $bookId)
    {
        $regionId = $data->region_id;
        $r = $this->r->getRegion($regionId, $bookId); 
        if (!$r) {
            //create new region
            echo "creating new region\n";
            $r = $this->r->newRegion($data, $bookId);
        } else {
            //region exist
            echo "existing region\n";
            //$e = $this->update($data, $bookId, $e);
        }
        return $r;
    }
    
       
}

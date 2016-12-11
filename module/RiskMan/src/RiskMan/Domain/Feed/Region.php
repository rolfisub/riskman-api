<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Domain\Feed;
use RiskMan\Domain\Feed\DomainFeedObject;
use RiskMan\Entity\Feed\Region as ERegion;


/**
 * Description of Region
 *
 * @author rolf
 */
class Region extends DomainFeedObject
{
    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    /*
     * @var RiskMan\Entity\Feed\Region
     */
    protected $r;
    
    /*
     * constructor TODO: Annotations
     */
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->em = $em;
    }
    
    //POST
    public function create ($data, $bookId)
    {
        $region_id = $data->region_id;
        $r = $this->_exists('Region', $bookId, 'region_id', $region_id);
        if (!$r) {
            //create new region
            echo "creating new region\n";
            $r = $this->_newRegion($data, $bookId);
        } else {
            //update region data if any
            echo "existing region\n";
            $r = $this->update($data, $bookId, $r);
        }
        $this->r = $r;
        $this->em->flush();
        return $this->r;
    }
    
    public function update ($data, $bookId, $r = null)
    {
        $region_id = $data->region_id;
        if (!$r){
            $r = $this->_exists('Region', $bookId, 'region_id', $region_id);
        }
        if (!$r) {
            //create new region
            echo "new region\n";
            $r = $this->create($data, $bookId);
        } else {
            //update region data if any
            echo "updating existing region\n";
            $r = $this->_updateRegion($data, $r);
        }
        $this->r = $r;
        $this->em->flush();
        return $this->r;
    }
    
    private function _newRegion ($data, $bookId)
    {
        $r = new ERegion();
        $r = $r->setBookId($bookId)
                ->setRegionId($data->region_id);
        if($data->region_name) {
            $r = $r->setName ($data->region_name);
        }
        $this->em->persist($r);
        return $r;
    }
    
    private function _updateRegion ($data, $r)
    {
        if($data->region_name) {
            $r = $r->setName ($data->region_name);
        }
        $this->em->persist($r);
        return $r;
    }
    
       
}

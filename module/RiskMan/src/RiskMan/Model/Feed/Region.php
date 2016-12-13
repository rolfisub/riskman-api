<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Model\Feed;
use RiskMan\Model\Feed\ModelFeedObject;
use Doctrine\ORM\EntityManager;
use RiskMan\Entity\Feed\Region as ERegion;
/**
 * Description of Region
 *
 * @author rolf
 */
class Region extends ModelFeedObject
{
    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    
    public function __construct(EntityManager $em) 
    {
        parent::__construct($em);
        if(null === $this->em){
            $this->em = $em;
        }
        $this->entity_path .= 'Region';
    }
    
    public function getRegion($regionId, $bookId)
    {
        
        $e = $this->_findOneBy($this->entity_path, [
            'region_id' => $regionId,
            'book_id' => $bookId
        ]);
        return $this->_toArray($e);
    }
    
    public function newRegion($data, $bookId)
    {
        $e = new ERegion();
        $e->setBookId($bookId)
                ->setRegionId($data->region_id);
        if ($data->region_name) {
           $e->setName($data->region_name);
        }
        $this->em->persist($e);
        $this->em->flush();
        return $this->_toArray($e);
    }
    
    protected function _toArray(ERegion $e)
    {
        if(!$e) {
            return false;
        }
        return [
            'id' => $e->getId(),
            'region_id' => $e->getRegionId(),
            'region_name' => $e->getName(),
        ];
    }
}

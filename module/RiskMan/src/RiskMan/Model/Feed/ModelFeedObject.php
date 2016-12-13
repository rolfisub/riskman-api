<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Model\Feed;
use RiskMan\Model\ModelObject;

/**
 * Description of ModelFeedObject
 *
 * @author rolf
 */
class ModelFeedObject extends ModelObject
{
    /*
     * @var string
     */
    protected $entity_path;
    
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity_path = 'RiskMan\\Entity\\Feed\\';
    }
    
    
}

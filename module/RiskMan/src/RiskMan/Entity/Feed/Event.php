<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Entity\Feed;
use RiskMan\Entity\Feed\BaseFeedEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Sport
 *
 * @author rolf
 * @ORM\Entity
 * @ORM\Table(name="event")
 * @property int $id 
 * @property int $book_id 
 * @property string $event_id 
 * @property string $name
 * @property datetime $datetime
 * @property int $sport_id
 * @property int $league_id
 * @property int $region_id
 */
class Event extends BaseFeedEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $event_id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $datetime;
    
    /**
     * @ORM\Column(name="sport_id", type="integer")
     * @ORM\ManyToOne(targetEntity="Sport")
     * @ORM\JoinColumn(name="sport_id", referencedColumnName="id")
     */
    protected $sport;
    
    /**
     * @ORM\Column(name="league_id", type="integer")
     * @ORM\ManyToOne(targetEntity="League")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id")
     */
    protected $league;
    
    /**
     * @ORM\Column(name="region_id", type="integer")
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     */
    protected $region;
        
    

}

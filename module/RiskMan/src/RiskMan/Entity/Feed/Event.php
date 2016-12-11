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
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $datetime;
    
    /**
     * @ORM\Column(name="sport_id", type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="Sport")
     * @ORM\JoinColumn(name="sport_id", referencedColumnName="id")
     */
    protected $sport;
    
    /**
     * @ORM\Column(name="league_id", type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="League")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id")
     */
    protected $league;
    
    /**
     * @ORM\Column(name="region_id", type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     */
    protected $region;
        
    


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set eventId
     *
     * @param string $eventId
     *
     * @return Event
     */
    public function setEventId($eventId)
    {
        $this->event_id = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return string
     */
    public function getEventId()
    {
        return $this->event_id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Event
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set sport
     *
     * @param integer $sport
     *
     * @return Event
     */
    public function setSport($sport)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Get sport
     *
     * @return integer
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Set league
     *
     * @param integer $league
     *
     * @return Event
     */
    public function setLeague($league)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * Get league
     *
     * @return integer
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * Set region
     *
     * @param integer $region
     *
     * @return Event
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return integer
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set bookId
     *
     * @param integer $bookId
     *
     * @return Event
     */
    public function setBookId($bookId)
    {
        $this->book_id = $bookId;

        return $this;
    }

    /**
     * Get bookId
     *
     * @return integer
     */
    public function getBookId()
    {
        return $this->book_id;
    }
    
    
}

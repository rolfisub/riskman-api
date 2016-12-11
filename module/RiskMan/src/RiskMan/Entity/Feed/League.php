<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Entity\Feed;
use RiskMan\Entity\Feed\BaseFeedEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of league
 *
 * @author rolf
 * @ORM\Entity
 * @ORM\Table(name="league")
 * @property int $id 
 * @property int $book_id 
 * @property string $league_id 
 * @property string $name 
 */
class League extends BaseFeedEntity
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
    protected $league_id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="League")
     */
    protected $events;
    
    /**
     * Initialize
     */
    public function __construct() 
    {
       $this->events = new ArrayCollection();
    }


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
     * Set leagueId
     *
     * @param string $leagueId
     *
     * @return League
     */
    public function setLeagueId($leagueId)
    {
        $this->league_id = $leagueId;

        return $this;
    }

    /**
     * Get leagueId
     *
     * @return string
     */
    public function getLeagueId()
    {
        return $this->league_id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return League
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
     * Set bookId
     *
     * @param integer $bookId
     *
     * @return League
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

    /**
     * Add event
     *
     * @param \RiskMan\Entity\Feed\Event $event
     *
     * @return League
     */
    public function addEvent(\RiskMan\Entity\Feed\Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \RiskMan\Entity\Feed\Event $event
     */
    public function removeEvent(\RiskMan\Entity\Feed\Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}

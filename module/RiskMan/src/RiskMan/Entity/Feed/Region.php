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
 * @ORM\Table(name="region")
 * @property int $id 
 * @property int $book_id 
 * @property string $region_id 
 * @property string $name 
 */
class Region extends BaseFeedEntity
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
    protected $region_id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="Region")
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
     * Set regionId
     *
     * @param string $regionId
     *
     * @return Region
     */
    public function setRegionId($regionId)
    {
        $this->region_id = $regionId;

        return $this;
    }

    /**
     * Get regionId
     *
     * @return string
     */
    public function getRegionId()
    {
        return $this->region_id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Region
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
     * @return Region
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
     * @return Region
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

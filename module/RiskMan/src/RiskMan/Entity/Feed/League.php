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

}

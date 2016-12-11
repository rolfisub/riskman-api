<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Entity\Feed;
use RiskMan\Entity\MagicClass;
use Doctrine\ORM\Mapping as ORM;
/**
 * Description of BaseFeedEntity
 *
 * @author rolf
 * @ORM\MappedSuperclass
 * @property int $book_id 
 */
class BaseFeedEntity extends MagicClass 
{
    /**
     * @ORM\Column(name="book_id", type="integer")
     * @ORM\ManyToOne(targetEntity="RiskMan\Entity\Book")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     */
    protected $book_id;
}

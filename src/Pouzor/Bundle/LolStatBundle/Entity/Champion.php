<?php

namespace Pouzor\Bundle\LolStatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Champion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pouzor\Bundle\LolStatBundle\Repository\ChampionRepository")
 */
class Champion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Collection Games
     *
     * @ORM\OneToMany(targetEntity="Pouzor\LolStatBundle\Entity\Game", mappedBy="idChampion", cascade={"all"})
     */
    private $games;



    public function __construct() {
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set id
     *
     *  
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $position;


    /**
     * Set name
     *
     * @param string $name
     * @return Champion
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
     * Set position
     *
     * @param string $position
     * @return Champion
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $blurb;


    /**
     * Set title
     *
     * @param string $title
     * @return Champion
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set blurb
     *
     * @param string $blurb
     * @return Champion
     */
    public function setBlurb($blurb)
    {
        $this->blurb = $blurb;
    
        return $this;
    }

    /**
     * Get blurb
     *
     * @return string 
     */
    public function getBlurb()
    {
        return $this->blurb;
    }

    /**
     * Add games
     *
     * @param \Pouzor\Bundle\LolStatBundle\Entity\Game $games
     * @return Champion
     */
    public function addGame(\Pouzor\Bundle\LolStatBundle\Entity\Game $games)
    {
        $this->games[] = $games;
    
        return $this;
    }

    /**
     * Remove games
     *
     * @param \Pouzor\Bundle\LolStatBundle\Entity\Game $games
     */
    public function removeGame(\Pouzor\Bundle\LolStatBundle\Entity\Game $games)
    {
        $this->games->removeElement($games);
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGames()
    {
        return $this->games;
    }
}
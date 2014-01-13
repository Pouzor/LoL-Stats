<?php

namespace Pouzor\Bundle\LolStatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pouzor\Bundle\LolStatBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


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
    private $server;

    /**
     * @var string
     */
    private $summonersname;

    /**
     * @var integer
     */
    private $summonersid = 0;

    /**
     * @var integer
     */
    private $accountid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ranks;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $games;

    /**
     * @var integer
     */
    private $points;

    /**
     * @var string
     */
    private $league;

    /**
     * @var integer
     */
    private $division;


    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set summonersname
     *
     * @param string $summonersname
     * @return User
     */
    public function setSummonersname($summonersname)
    {
        $this->summonersname = $summonersname;

        return $this;
    }

    /**
     * Get summonersname
     *
     * @return string
     */
    public function getSummonersname()
    {
        return $this->summonersname;
    }

    /**
     * Set summonersid
     *
     * @param integer $summonersid
     * @return User
     */
    public function setSummonersid($summonersid)
    {
        $this->summonersid = $summonersid;

        return $this;
    }

    /**
     * Get summonersid
     *
     * @return integer
     */
    public function getSummonersid()
    {
        return $this->summonersid;
    }



    /**
     * Set server
     *
     * @param string $server
     * @return User
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Get server
     *
     * @return string
     */
    public function getServer()
    {
        return $this->server;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add games
     *
     * @param \Pouzor\Bundle\LolStatBundle\Entity\Game $games
     * @return User
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



    /**
     * Add ranks
     *
     * @param \Pouzor\Bundle\LolStatBundle\Entity\UserRank $ranks
     * @return User
     */
    public function addRank(\Pouzor\Bundle\LolStatBundle\Entity\UserRank $ranks)
    {
        $this->ranks[] = $ranks;

        return $this;
    }

    /**
     * Remove ranks
     *
     * @param \Pouzor\Bundle\LolStatBundle\Entity\UserRank $ranks
     */
    public function removeRank(\Pouzor\Bundle\LolStatBundle\Entity\UserRank $ranks)
    {
        $this->ranks->removeElement($ranks);
    }

    /**
     * Get ranks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRanks()
    {
        return $this->ranks;
    }



    /**
     * Set points
     *
     * @param integer $points
     * @return User
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set league
     *
     * @param string $league
     * @return User
     */
    public function setLeague($league)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * Get league
     *
     * @return string
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * Set division
     *
     * @param integer $division
     * @return User
     */
    public function setDivision($division)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return integer
     */
    public function getDivision()
    {
        return $this->division;
    }



    /**
     * Set accountid
     *
     * @param integer $accountid
     * @return User
     */
    public function setAccountid($accountid)
    {
        $this->accountid = $accountid;

        return $this;
    }

    /**
     * Get accountid
     *
     * @return integer
     */
    public function getAccountid()
    {
        return $this->accountid;
    }
}

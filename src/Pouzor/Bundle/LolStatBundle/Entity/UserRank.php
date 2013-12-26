<?php

namespace Pouzor\Bundle\LolStatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRank
 */
class UserRank
{
    /**
     * @var integer
     */
    private $id;

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
     * @var integer
     */
    private $score;

    /**
     * @var \Pouzor\Bundle\LolStatBundle\Entity\User
     */
    private $idUser;

    /**
     * @var \DateTime
     */
    private $rankDate;

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
     * Set league
     *
     * @param string $league
     * @return UserRank
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
     * @return UserRank
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
     * Set score
     *
     * @param integer $score
     * @return UserRank
     */
    public function setScore($score)
    {
        $this->score = $score;
    
        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set idUser
     *
     * @param \Pouzor\Bundle\LolStatBundle\Entity\User $idUser
     * @return UserRank
     */
    public function setIdUser(\Pouzor\Bundle\LolStatBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;
    
        return $this;
    }

    /**
     * Get idUser
     *
     * @return \Pouzor\Bundle\LolStatBundle\Entity\User 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }



    /**
     * Set points
     *
     * @param integer $points
     * @return UserRank
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
     * Set rankDate
     *
     * @param \DateTime $rankDate
     * @return UserRank
     */
    public function setRankDate($rankDate)
    {
        $this->rankDate = $rankDate;
    
        return $this;
    }

    /**
     * Get rankDate
     *
     * @return \DateTime 
     */
    public function getRankDate()
    {
        return $this->rankDate;
    }
}
<?php

namespace Pouzor\Bundle\LolStatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserElo
 */
class UserElo
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $elo;

    /**
     * @var string
     */
    private $league;

    /**
     * @var integer
     */
    private $division;


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
     * Set elo
     *
     * @param integer $elo
     * @return UserElo
     */
    public function setElo($elo)
    {
        $this->elo = $elo;
    
        return $this;
    }

    /**
     * Get elo
     *
     * @return integer 
     */
    public function getElo()
    {
        return $this->elo;
    }

    /**
     * Set league
     *
     * @param string $league
     * @return UserElo
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
     * @return UserElo
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
     * @var \DateTime
     */
    private $eloDate;

    /**
     * @var integer
     */
    private $score;

    /**
     * @var \Pouzor\Bundle\LolStatBundle\Entity\User
     */
    private $idUser;


    /**
     * Set eloDate
     *
     * @param \DateTime $eloDate
     * @return UserElo
     */
    public function setEloDate($eloDate)
    {
        $this->eloDate = $eloDate;
    
        return $this;
    }

    /**
     * Get eloDate
     *
     * @return \DateTime 
     */
    public function getEloDate()
    {
        return $this->eloDate;
    }

    /**
     * Set score
     *
     * @param integer $score
     * @return UserElo
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
     * @return UserElo
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
}
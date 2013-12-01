<?php

namespace Pouzor\Bundle\LolStatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 * @ORM\Entity(repositoryClass="Pouzor\Bundle\LolStatBundle\Repository\GameRepository")
 * @ORM\Table()
 */
class Game
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var integer
     */
    private $idMatch;

    /**
     * @var integer
     */
    private $idUser;

    /**
     * @var integer
     */
    private $premadesize;

    /**
     * @var boolean
     */
    private $ranked;

    /**
     * @var string
     */
    private $matchType;

    /**
     * @var string
     */
    private $matchDate;

    /**
     * @var integer
     */
    private $idChampion;

    /**
     * @var integer
     */
    private $gold;

    /**
     * @var integer
     */
    private $timeDead;

    /**
     * @var integer
     */
    private $killed;

    /**
     * @var integer
     */
    private $death;

    /**
     * @var integer
     */
    private $assist;

    /**
     * @var integer
     */
    private $elochange;

    /**
     * @var integer
     */
    private $ipearned;

    /**
     * @var string
     */
    private $queuetype;

    /**
     * @var integer
     */
    private $damagetochampion;

    /**
     * @var integer
     */
    private $minionsKilled;

    /**
     * @var integer
     */
    private $totalDamageTaken;

    /**
     * @var integer
     */
    private $turretsKilled;

    /**
     * @var integer
     */
    private $win;

    /**
     * @var string
     */
    private $item0;

    /**
     * @var string
     */
    private $item1;

    /**
     * @var string
     */
    private $item2;

    /**
     * @var string
     */
    private $item3;

    /**
     * @var string
     */
    private $item4;

    /**
     * @var string
     */
    private $item5;

    /**
     * @var string
     */
    private $item6;

    /**
     * Set idMatch
     *
     * @param integer $idMatch
     * @return Game
     */
    public function setIdMatch($idMatch)
    {
        $this->idMatch = $idMatch;
    
        return $this;
    }

    /**
     * Get idMatch
     *
     * @return integer 
     */
    public function getIdMatch()
    {
        return $this->idMatch;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     * @return Game
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    
        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set premadesize
     *
     * @param integer $premadesize
     * @return Game
     */
    public function setPremadesize($premadesize)
    {
        $this->premadesize = $premadesize;
    
        return $this;
    }

    /**
     * Get premadesize
     *
     * @return integer 
     */
    public function getPremadesize()
    {
        return $this->premadesize;
    }

    /**
     * Set ranked
     *
     * @param boolean $ranked
     * @return Game
     */
    public function setRanked($ranked)
    {
        $this->ranked = $ranked;
    
        return $this;
    }

    /**
     * Get ranked
     *
     * @return boolean 
     */
    public function getRanked()
    {
        return $this->ranked;
    }

    /**
     * Set matchType
     *
     * @param string $matchType
     * @return Game
     */
    public function setMatchType($matchType)
    {
        $this->matchType = $matchType;
    
        return $this;
    }

    /**
     * Get matchType
     *
     * @return string 
     */
    public function getMatchType()
    {
        return $this->matchType;
    }

    /**
     * Set matchDate
     *
     * @param string $matchDate
     * @return Game
     */
    public function setMatchDate($matchDate)
    {
        $this->matchDate = $matchDate;
    
        return $this;
    }

    /**
     * Get matchDate
     *
     * @return string 
     */
    public function getMatchDate()
    {
        return $this->matchDate;
    }

    /**
     * Set idChampion
     *
     * @param integer $idChampion
     * @return Game
     */
    public function setIdChampion($idChampion)
    {
        $this->idChampion = $idChampion;
    
        return $this;
    }

    /**
     * Get idChampion
     *
     * @return integer 
     */
    public function getIdChampion()
    {
        return $this->idChampion;
    }

    /**
     * Set gold
     *
     * @param integer $gold
     * @return Game
     */
    public function setGold($gold)
    {
        $this->gold = $gold;
    
        return $this;
    }

    /**
     * Get gold
     *
     * @return integer 
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set timeDead
     *
     * @param integer $timeDead
     * @return Game
     */
    public function setTimeDead($timeDead)
    {
        $this->timeDead = $timeDead;
    
        return $this;
    }

    /**
     * Get timeDead
     *
     * @return integer 
     */
    public function getTimeDead()
    {
        return $this->timeDead;
    }

    /**
     * Set killed
     *
     * @param integer $killed
     * @return Game
     */
    public function setKilled($killed)
    {
        $this->killed = $killed;
    
        return $this;
    }

    /**
     * Get killed
     *
     * @return integer 
     */
    public function getKilled()
    {
        return $this->killed;
    }

    /**
     * Set death
     *
     * @param integer $death
     * @return Game
     */
    public function setDeath($death)
    {
        $this->death = $death;
    
        return $this;
    }

    /**
     * Get death
     *
     * @return integer 
     */
    public function getDeath()
    {
        return $this->death;
    }

    /**
     * Set assist
     *
     * @param integer $assist
     * @return Game
     */
    public function setAssist($assist)
    {
        $this->assist = $assist;
    
        return $this;
    }

    /**
     * Get assist
     *
     * @return integer 
     */
    public function getAssist()
    {
        return $this->assist;
    }

    /**
     * Set elochange
     *
     * @param integer $elochange
     * @return Game
     */
    public function setElochange($elochange)
    {
        $this->elochange = $elochange;
    
        return $this;
    }

    /**
     * Get elochange
     *
     * @return integer 
     */
    public function getElochange()
    {
        return $this->elochange;
    }

    /**
     * Set ipearned
     *
     * @param integer $ipearned
     * @return Game
     */
    public function setIpearned($ipearned)
    {
        $this->ipearned = $ipearned;
    
        return $this;
    }

    /**
     * Get ipearned
     *
     * @return integer 
     */
    public function getIpearned()
    {
        return $this->ipearned;
    }

    /**
     * Set queuetype
     *
     * @param string $queuetype
     * @return Game
     */
    public function setQueuetype($queuetype)
    {
        $this->queuetype = $queuetype;
    
        return $this;
    }

    /**
     * Get queuetype
     *
     * @return string 
     */
    public function getQueuetype()
    {
        return $this->queuetype;
    }

    /**
     * Set damagetochampion
     *
     * @param integer $damagetochampion
     * @return Game
     */
    public function setDamagetochampion($damagetochampion)
    {
        $this->damagetochampion = $damagetochampion;
    
        return $this;
    }

    /**
     * Get damagetochampion
     *
     * @return integer 
     */
    public function getDamagetochampion()
    {
        return $this->damagetochampion;
    }

    /**
     * Set minionsKilled
     *
     * @param integer $minionsKilled
     * @return Game
     */
    public function setMinionsKilled($minionsKilled)
    {
        $this->minionsKilled = $minionsKilled;
    
        return $this;
    }

    /**
     * Get minionsKilled
     *
     * @return integer 
     */
    public function getMinionsKilled()
    {
        return $this->minionsKilled;
    }

    /**
     * Set totalDamageTaken
     *
     * @param integer $totalDamageTaken
     * @return Game
     */
    public function setTotalDamageTaken($totalDamageTaken)
    {
        $this->totalDamageTaken = $totalDamageTaken;
    
        return $this;
    }

    /**
     * Get totalDamageTaken
     *
     * @return integer 
     */
    public function getTotalDamageTaken()
    {
        return $this->totalDamageTaken;
    }

    /**
     * Set turretsKilled
     *
     * @param integer $turretsKilled
     * @return Game
     */
    public function setTurretsKilled($turretsKilled)
    {
        $this->turretsKilled = $turretsKilled;
    
        return $this;
    }

    /**
     * Get turretsKilled
     *
     * @return integer 
     */
    public function getTurretsKilled()
    {
        return $this->turretsKilled;
    }

    /**
     * Set win
     *
     * @param integer $win
     * @return Game
     */
    public function setWin($win)
    {
        $this->win = $win;
    
        return $this;
    }

    /**
     * Get win
     *
     * @return integer 
     */
    public function getWin()
    {
        return $this->win;
    }

    /**
     * Set item0
     *
     * @param string $item0
     * @return Game
     */
    public function setItem0($item0)
    {
        $this->item0 = $item0;
    
        return $this;
    }

    /**
     * Get item0
     *
     * @return string 
     */
    public function getItem0()
    {
        return $this->item0;
    }

    /**
     * Set item1
     *
     * @param string $item1
     * @return Game
     */
    public function setItem1($item1)
    {
        $this->item1 = $item1;
    
        return $this;
    }

    /**
     * Get item1
     *
     * @return string 
     */
    public function getItem1()
    {
        return $this->item1;
    }

    /**
     * Set item2
     *
     * @param string $item2
     * @return Game
     */
    public function setItem2($item2)
    {
        $this->item2 = $item2;
    
        return $this;
    }

    /**
     * Get item2
     *
     * @return string 
     */
    public function getItem2()
    {
        return $this->item2;
    }

    /**
     * Set item3
     *
     * @param string $item3
     * @return Game
     */
    public function setItem3($item3)
    {
        $this->item3 = $item3;
    
        return $this;
    }

    /**
     * Get item3
     *
     * @return string 
     */
    public function getItem3()
    {
        return $this->item3;
    }

    /**
     * Set item4
     *
     * @param string $item4
     * @return Game
     */
    public function setItem4($item4)
    {
        $this->item4 = $item4;
    
        return $this;
    }

    /**
     * Get item4
     *
     * @return string 
     */
    public function getItem4()
    {
        return $this->item4;
    }

    /**
     * Set item5
     *
     * @param string $item5
     * @return Game
     */
    public function setItem5($item5)
    {
        $this->item5 = $item5;
    
        return $this;
    }

    /**
     * Get item5
     *
     * @return string 
     */
    public function getItem5()
    {
        return $this->item5;
    }

    /**
     * Set item6
     *
     * @param string $item6
     * @return Game
     */
    public function setItem6($item6)
    {
        $this->item6 = $item6;
    
        return $this;
    }

    /**
     * Get item6
     *
     * @return string 
     */
    public function getItem6()
    {
        return $this->item6;
    }
}
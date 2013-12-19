<?php

namespace Pouzor\Bundle\LolStatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pouzor\Bundle\LolStatBundle\Repository\UserRepository")
 */
class User
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
    private $summonersid;


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
}
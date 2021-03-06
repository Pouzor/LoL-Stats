<?php

namespace Pouzor\Bundle\LolStatBundle\Entity;

/**
 * Item
 */
class Item
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $groups;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $plaintext;

    /**
     * @var integer
     */
    private $totalCost;


    /**
    *
    * @param integer $id
    * @return Item
    */
    public function setId($id) {
        $this->id = $id;

        return $this;
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
     * Set name
     *
     * @param string $name
     * @return Item
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
     * Set groups
     *
     * @param string $groups
     * @return Item
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return string
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Item
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set plaintext
     *
     * @param string $plaintext
     * @return Item
     */
    public function setPlaintext($plaintext)
    {
        $this->plaintext = $plaintext;

        return $this;
    }

    /**
     * Get plaintext
     *
     * @return string
     */
    public function getPlaintext()
    {
        return $this->plaintext;
    }

    /**
     * Set totalCost
     *
     * @param integer $totalCost
     * @return Item
     */
    public function setTotalCost($totalCost)
    {
        $this->totalCost = $totalCost;

        return $this;
    }

    /**
     * Get totalCost
     *
     * @return integer
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $games;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add games
     *
     * @param \Pouzor\Bundle\LolStatBundle\Entity\Game $games
     * @return Item
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
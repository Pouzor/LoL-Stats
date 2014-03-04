<?php

namespace Pouzor\Bundle\LolStatBundle\Entity;

/**
 * Register
 */
class Register
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $server;

    /**
     * @var boolean
     */
    private $validate;


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
     * Set email
     *
     * @param string $email
     * @return Register
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Register
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
     * Set server
     *
     * @param string $server
     * @return Register
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
     * Set validate
     *
     * @param boolean $validate
     * @return Register
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;
    
        return $this;
    }

    /**
     * Get validate
     *
     * @return boolean 
     */
    public function getValidate()
    {
        return $this->validate;
    }
}
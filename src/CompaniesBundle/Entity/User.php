<?php

namespace CompaniesBundle\Entity;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $qq;

    /**
     * @var string
     */
    private $mobile;

    /**
     * @var integer
     */
    private $utype = '0';

    /**
     * @var integer
     */
    private $status = '1';

    /**
     * @var \DateTime
     */
    private $registertime;


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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
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
     * Set qq
     *
     * @param string $qq
     *
     * @return User
     */
    public function setQq($qq)
    {
        $this->qq = $qq;

        return $this;
    }

    /**
     * Get qq
     *
     * @return string
     */
    public function getQq()
    {
        return $this->qq;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     *
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set utype
     *
     * @param integer $utype
     *
     * @return User
     */
    public function setUtype($utype)
    {
        $this->utype = $utype;

        return $this;
    }

    /**
     * Get utype
     *
     * @return integer
     */
    public function getUtype()
    {
        return $this->utype;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set registertime
     *
     * @param \DateTime $registertime
     *
     * @return User
     */
    public function setRegistertime($registertime)
    {
        $this->registertime = $registertime;

        return $this;
    }

    /**
     * Get registertime
     *
     * @return \DateTime
     */
    public function getRegistertime()
    {
        return $this->registertime;
    }
}


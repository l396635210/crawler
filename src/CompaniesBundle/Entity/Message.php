<?php

namespace CompaniesBundle\Entity;

/**
 * Message
 */
class Message
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $companyId;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $message;

    /**
     * @var integer
     */
    private $status = '1';

    /**
     * @var \DateTime
     */
    private $addtime;

    /**
     * @var integer
     */
    private $sex = '1';

    /**
     * @var string
     */
    private $telephone;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Message
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set companyId
     *
     * @param integer $companyId
     *
     * @return Message
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return Message
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Message
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
     * Set company
     *
     * @param string $company
     *
     * @return Message
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Message
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
     * Set addtime
     *
     * @param \DateTime $addtime
     *
     * @return Message
     */
    public function setAddtime($addtime)
    {
        $this->addtime = $addtime;

        return $this;
    }

    /**
     * Get addtime
     *
     * @return \DateTime
     */
    public function getAddtime()
    {
        return $this->addtime;
    }

    /**
     * Set sex
     *
     * @param integer $sex
     *
     * @return Message
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return integer
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Message
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}


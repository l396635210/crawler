<?php

namespace CompaniesBundle\Entity;

/**
 * Claim
 */
class Claim
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
    private $licenseUrl;

    /**
     * @var string
     */
    private $linkUser;

    /**
     * @var string
     */
    private $telphone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \DateTime
     */
    private $addtime;

    /**
     * @var integer
     */
    private $status = '1';

    /**
     * @var integer
     */
    private $sex = '1';

    /**
     * @var string
     */
    private $result;

    /**
     * @var \DateTime
     */
    private $claimtime;


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
     * @return Claim
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
     * @return Claim
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
     * Set licenseUrl
     *
     * @param string $licenseUrl
     *
     * @return Claim
     */
    public function setLicenseUrl($licenseUrl)
    {
        $this->licenseUrl = $licenseUrl;

        return $this;
    }

    /**
     * Get licenseUrl
     *
     * @return string
     */
    public function getLicenseUrl()
    {
        return $this->licenseUrl;
    }

    /**
     * Set linkUser
     *
     * @param string $linkUser
     *
     * @return Claim
     */
    public function setLinkUser($linkUser)
    {
        $this->linkUser = $linkUser;

        return $this;
    }

    /**
     * Get linkUser
     *
     * @return string
     */
    public function getLinkUser()
    {
        return $this->linkUser;
    }

    /**
     * Set telphone
     *
     * @param string $telphone
     *
     * @return Claim
     */
    public function setTelphone($telphone)
    {
        $this->telphone = $telphone;

        return $this;
    }

    /**
     * Get telphone
     *
     * @return string
     */
    public function getTelphone()
    {
        return $this->telphone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Claim
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
     * Set addtime
     *
     * @param \DateTime $addtime
     *
     * @return Claim
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
     * Set status
     *
     * @param integer $status
     *
     * @return Claim
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
     * Set sex
     *
     * @param integer $sex
     *
     * @return Claim
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
     * Set result
     *
     * @param string $result
     *
     * @return Claim
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set claimtime
     *
     * @param \DateTime $claimtime
     *
     * @return Claim
     */
    public function setClaimtime($claimtime)
    {
        $this->claimtime = $claimtime;

        return $this;
    }

    /**
     * Get claimtime
     *
     * @return \DateTime
     */
    public function getClaimtime()
    {
        return $this->claimtime;
    }
}


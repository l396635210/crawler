<?php

namespace CompaniesBundle\Entity;

/**
 * CompanyStat
 */
class CompanyStat
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $companyId;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var \DateTime
     */
    private $addtime;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $useragent;

    /**
     * @var string
     */
    private $referer;

    /**
     * @var integer
     */
    private $userId;


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
     * Set companyId
     *
     * @param integer $companyId
     *
     * @return CompanyStat
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
     * Set ip
     *
     * @param string $ip
     *
     * @return CompanyStat
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set addtime
     *
     * @param \DateTime $addtime
     *
     * @return CompanyStat
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
     * Set url
     *
     * @param string $url
     *
     * @return CompanyStat
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set useragent
     *
     * @param string $useragent
     *
     * @return CompanyStat
     */
    public function setUseragent($useragent)
    {
        $this->useragent = $useragent;

        return $this;
    }

    /**
     * Get useragent
     *
     * @return string
     */
    public function getUseragent()
    {
        return $this->useragent;
    }

    /**
     * Set referer
     *
     * @param string $referer
     *
     * @return CompanyStat
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;

        return $this;
    }

    /**
     * Get referer
     *
     * @return string
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return CompanyStat
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
}


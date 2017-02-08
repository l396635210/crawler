<?php

namespace CompaniesBundle\Entity;

/**
 * Log
 */
class Log
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $userid;

    /**
     * @var string
     */
    private $opType;

    /**
     * @var string
     */
    private $opContent;

    /**
     * @var \DateTime
     */
    private $addtime;

    /**
     * @var string
     */
    private $ip;


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
     * Set userid
     *
     * @param integer $userid
     *
     * @return Log
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set opType
     *
     * @param string $opType
     *
     * @return Log
     */
    public function setOpType($opType)
    {
        $this->opType = $opType;

        return $this;
    }

    /**
     * Get opType
     *
     * @return string
     */
    public function getOpType()
    {
        return $this->opType;
    }

    /**
     * Set opContent
     *
     * @param string $opContent
     *
     * @return Log
     */
    public function setOpContent($opContent)
    {
        $this->opContent = $opContent;

        return $this;
    }

    /**
     * Get opContent
     *
     * @return string
     */
    public function getOpContent()
    {
        return $this->opContent;
    }

    /**
     * Set addtime
     *
     * @param \DateTime $addtime
     *
     * @return Log
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
     * Set ip
     *
     * @param string $ip
     *
     * @return Log
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
}


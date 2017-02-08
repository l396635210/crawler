<?php

namespace CompaniesBundle\Entity;

/**
 * Search
 */
class Search
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $tagId;

    /**
     * @var string
     */
    private $keyword;

    /**
     * @var integer
     */
    private $result;

    /**
     * @var integer
     */
    private $userId;

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
     * Set tagId
     *
     * @param integer $tagId
     *
     * @return Search
     */
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;

        return $this;
    }

    /**
     * Get tagId
     *
     * @return integer
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     *
     * @return Search
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set result
     *
     * @param integer $result
     *
     * @return Search
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return integer
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Search
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
     * Set addtime
     *
     * @param \DateTime $addtime
     *
     * @return Search
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
     * @return Search
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


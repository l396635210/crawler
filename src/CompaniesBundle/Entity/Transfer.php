<?php

namespace CompaniesBundle\Entity;

/**
 * Transfer
 */
class Transfer
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
     * @var integer
     */
    private $fromUserId;

    /**
     * @var integer
     */
    private $toUserId;

    /**
     * @var integer
     */
    private $addUserId;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $attachment;

    /**
     * @var \DateTime
     */
    private $addtime;

    /**
     * @var string
     */
    private $addIp;

    /**
     * @var integer
     */
    private $status = '1';

    /**
     * @var \DateTime
     */
    private $checktime;

    /**
     * @var integer
     */
    private $checkUserId;

    /**
     * @var string
     */
    private $checkIp;

    /**
     * @var string
     */
    private $checkMemo;


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
     * @return Transfer
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
     * Set fromUserId
     *
     * @param integer $fromUserId
     *
     * @return Transfer
     */
    public function setFromUserId($fromUserId)
    {
        $this->fromUserId = $fromUserId;

        return $this;
    }

    /**
     * Get fromUserId
     *
     * @return integer
     */
    public function getFromUserId()
    {
        return $this->fromUserId;
    }

    /**
     * Set toUserId
     *
     * @param integer $toUserId
     *
     * @return Transfer
     */
    public function setToUserId($toUserId)
    {
        $this->toUserId = $toUserId;

        return $this;
    }

    /**
     * Get toUserId
     *
     * @return integer
     */
    public function getToUserId()
    {
        return $this->toUserId;
    }

    /**
     * Set addUserId
     *
     * @param integer $addUserId
     *
     * @return Transfer
     */
    public function setAddUserId($addUserId)
    {
        $this->addUserId = $addUserId;

        return $this;
    }

    /**
     * Get addUserId
     *
     * @return integer
     */
    public function getAddUserId()
    {
        return $this->addUserId;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Transfer
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
     * Set attachment
     *
     * @param string $attachment
     *
     * @return Transfer
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }

    /**
     * Get attachment
     *
     * @return string
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set addtime
     *
     * @param \DateTime $addtime
     *
     * @return Transfer
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
     * Set addIp
     *
     * @param string $addIp
     *
     * @return Transfer
     */
    public function setAddIp($addIp)
    {
        $this->addIp = $addIp;

        return $this;
    }

    /**
     * Get addIp
     *
     * @return string
     */
    public function getAddIp()
    {
        return $this->addIp;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Transfer
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
     * Set checktime
     *
     * @param \DateTime $checktime
     *
     * @return Transfer
     */
    public function setChecktime($checktime)
    {
        $this->checktime = $checktime;

        return $this;
    }

    /**
     * Get checktime
     *
     * @return \DateTime
     */
    public function getChecktime()
    {
        return $this->checktime;
    }

    /**
     * Set checkUserId
     *
     * @param integer $checkUserId
     *
     * @return Transfer
     */
    public function setCheckUserId($checkUserId)
    {
        $this->checkUserId = $checkUserId;

        return $this;
    }

    /**
     * Get checkUserId
     *
     * @return integer
     */
    public function getCheckUserId()
    {
        return $this->checkUserId;
    }

    /**
     * Set checkIp
     *
     * @param string $checkIp
     *
     * @return Transfer
     */
    public function setCheckIp($checkIp)
    {
        $this->checkIp = $checkIp;

        return $this;
    }

    /**
     * Get checkIp
     *
     * @return string
     */
    public function getCheckIp()
    {
        return $this->checkIp;
    }

    /**
     * Set checkMemo
     *
     * @param string $checkMemo
     *
     * @return Transfer
     */
    public function setCheckMemo($checkMemo)
    {
        $this->checkMemo = $checkMemo;

        return $this;
    }

    /**
     * Get checkMemo
     *
     * @return string
     */
    public function getCheckMemo()
    {
        return $this->checkMemo;
    }
}


<?php

namespace CompaniesBundle\Entity;

/**
 * Require
 */
class Require
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $uid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var string
     */
    private $desc;

    /**
     * @var string
     */
    private $attachments;

    /**
     * @var \DateTime
     */
    private $deadline;

    /**
     * @var integer
     */
    private $areaId1;

    /**
     * @var integer
     */
    private $areaId2;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $linkman;

    /**
     * @var string
     */
    private $linkphone;

    /**
     * @var string
     */
    private $linkemail;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $createtime;


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
     * Set uid
     *
     * @param integer $uid
     *
     * @return Require
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return integer
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Require
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
     * Set type
     *
     * @param integer $type
     *
     * @return Require
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set desc
     *
     * @param string $desc
     *
     * @return Require
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * Get desc
     *
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * Set attachments
     *
     * @param string $attachments
     *
     * @return Require
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * Get attachments
     *
     * @return string
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Set deadline
     *
     * @param \DateTime $deadline
     *
     * @return Require
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get deadline
     *
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set areaId1
     *
     * @param integer $areaId1
     *
     * @return Require
     */
    public function setAreaId1($areaId1)
    {
        $this->areaId1 = $areaId1;

        return $this;
    }

    /**
     * Get areaId1
     *
     * @return integer
     */
    public function getAreaId1()
    {
        return $this->areaId1;
    }

    /**
     * Set areaId2
     *
     * @param integer $areaId2
     *
     * @return Require
     */
    public function setAreaId2($areaId2)
    {
        $this->areaId2 = $areaId2;

        return $this;
    }

    /**
     * Get areaId2
     *
     * @return integer
     */
    public function getAreaId2()
    {
        return $this->areaId2;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Require
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set linkman
     *
     * @param string $linkman
     *
     * @return Require
     */
    public function setLinkman($linkman)
    {
        $this->linkman = $linkman;

        return $this;
    }

    /**
     * Get linkman
     *
     * @return string
     */
    public function getLinkman()
    {
        return $this->linkman;
    }

    /**
     * Set linkphone
     *
     * @param string $linkphone
     *
     * @return Require
     */
    public function setLinkphone($linkphone)
    {
        $this->linkphone = $linkphone;

        return $this;
    }

    /**
     * Get linkphone
     *
     * @return string
     */
    public function getLinkphone()
    {
        return $this->linkphone;
    }

    /**
     * Set linkemail
     *
     * @param string $linkemail
     *
     * @return Require
     */
    public function setLinkemail($linkemail)
    {
        $this->linkemail = $linkemail;

        return $this;
    }

    /**
     * Get linkemail
     *
     * @return string
     */
    public function getLinkemail()
    {
        return $this->linkemail;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Require
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
     * Set createtime
     *
     * @param \DateTime $createtime
     *
     * @return Require
     */
    public function setCreatetime($createtime)
    {
        $this->createtime = $createtime;

        return $this;
    }

    /**
     * Get createtime
     *
     * @return \DateTime
     */
    public function getCreatetime()
    {
        return $this->createtime;
    }
}


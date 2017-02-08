<?php

namespace CompaniesBundle\Entity;

/**
 * CrmLinkedin
 */
class CrmLinkedin
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
     * @var integer
     */
    private $cid;


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
     * @return CrmLinkedin
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
     * Set cid
     *
     * @param integer $cid
     *
     * @return CrmLinkedin
     */
    public function setCid($cid)
    {
        $this->cid = $cid;

        return $this;
    }

    /**
     * Get cid
     *
     * @return integer
     */
    public function getCid()
    {
        return $this->cid;
    }
}


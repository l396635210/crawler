<?php

namespace CompaniesBundle\Entity;

/**
 * SgsVerify
 */
class SgsVerify
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
    private $serialno;

    /**
     * @var \DateTime
     */
    private $auditDate;

    /**
     * @var string
     */
    private $information;

    /**
     * @var string
     */
    private $reportUrl;

    /**
     * @var \DateTime
     */
    private $addDate;

    /**
     * @var integer
     */
    private $status = '1';

    /**
     * @var \DateTime
     */
    private $checkDate;

    /**
     * @var integer
     */
    private $checkUser;


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
     * @return SgsVerify
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
     * Set serialno
     *
     * @param string $serialno
     *
     * @return SgsVerify
     */
    public function setSerialno($serialno)
    {
        $this->serialno = $serialno;

        return $this;
    }

    /**
     * Get serialno
     *
     * @return string
     */
    public function getSerialno()
    {
        return $this->serialno;
    }

    /**
     * Set auditDate
     *
     * @param \DateTime $auditDate
     *
     * @return SgsVerify
     */
    public function setAuditDate($auditDate)
    {
        $this->auditDate = $auditDate;

        return $this;
    }

    /**
     * Get auditDate
     *
     * @return \DateTime
     */
    public function getAuditDate()
    {
        return $this->auditDate;
    }

    /**
     * Set information
     *
     * @param string $information
     *
     * @return SgsVerify
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set reportUrl
     *
     * @param string $reportUrl
     *
     * @return SgsVerify
     */
    public function setReportUrl($reportUrl)
    {
        $this->reportUrl = $reportUrl;

        return $this;
    }

    /**
     * Get reportUrl
     *
     * @return string
     */
    public function getReportUrl()
    {
        return $this->reportUrl;
    }

    /**
     * Set addDate
     *
     * @param \DateTime $addDate
     *
     * @return SgsVerify
     */
    public function setAddDate($addDate)
    {
        $this->addDate = $addDate;

        return $this;
    }

    /**
     * Get addDate
     *
     * @return \DateTime
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return SgsVerify
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
     * Set checkDate
     *
     * @param \DateTime $checkDate
     *
     * @return SgsVerify
     */
    public function setCheckDate($checkDate)
    {
        $this->checkDate = $checkDate;

        return $this;
    }

    /**
     * Get checkDate
     *
     * @return \DateTime
     */
    public function getCheckDate()
    {
        return $this->checkDate;
    }

    /**
     * Set checkUser
     *
     * @param integer $checkUser
     *
     * @return SgsVerify
     */
    public function setCheckUser($checkUser)
    {
        $this->checkUser = $checkUser;

        return $this;
    }

    /**
     * Get checkUser
     *
     * @return integer
     */
    public function getCheckUser()
    {
        return $this->checkUser;
    }
}


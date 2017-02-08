<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrawlerLog
 *
 * @ORM\Table(name="crawler_log")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CrawlerLogRepository")
 */
class CrawlerLog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="crawlerLogs")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

    /**
     * @var int
     *
     * @ORM\Column(name="company_id", type="integer")
     */
    private $companyId;

    /**
     * @var int
     *
     * @ORM\Column(name="crawler_count", type="integer")
     */
    private $crawlerCount;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_success", type="boolean")
     */
    private $isSuccess;

    /**
     * @var string
     *
     * @ORM\Column(name="exception", type="string", length=500, nullable=true)
     */
    private $exception;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time")
     */
    private $time;


    /**
     * Get id
     *
     * @return int
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
     * @return CrawlerLog
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set crawlerCount
     *
     * @param integer $crawlerCount
     *
     * @return CrawlerLog
     */
    public function setCrawlerCount($crawlerCount)
    {
        $this->crawlerCount = $crawlerCount;

        return $this;
    }

    /**
     * Get crawlerCount
     *
     * @return int
     */
    public function getCrawlerCount()
    {
        return $this->crawlerCount;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CrawlerLog
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return CrawlerLog
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->isSuccess ? "成功抓取{$this->crawlerCount}条信息" : '抓取失败';
    }

    /**
     * Set isSuccess
     *
     * @param boolean $isSuccess
     *
     * @return CrawlerLog
     */
    public function setIsSuccess($isSuccess)
    {
        $this->isSuccess = $isSuccess;

        return $this;
    }

    /**
     * Get isSuccess
     *
     * @return boolean
     */
    public function getIsSuccess()
    {
        return $this->isSuccess;
    }

    /**
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return CrawlerLog
     */
    public function setCompany(\AppBundle\Entity\Company $company = null)
    {
        $this->company = $company;
        $this->companyId = $company->getId();
        return $this;
    }

    /**
     * Get company
     *
     * @return \AppBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set exception
     *
     * @param string $exception
     *
     * @return CrawlerLog
     */
    public function setException($exception)
    {
        $this->exception = $exception;

        return $this;
    }

    /**
     * Get exception
     *
     * @return string
     */
    public function getException()
    {
        return $this->exception;
    }
}

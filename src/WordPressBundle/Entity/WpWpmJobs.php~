<?php

namespace WordPressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpWpmJobs
 *
 * @ORM\Table(name="wp_wpm_jobs", uniqueConstraints={@ORM\UniqueConstraint(name="job_post_id", columns={"job_post_id"})})
 * @ORM\Entity
 */
class WpWpmJobs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="job_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $jobId;

    /**
     * @var integer
     *
     * @ORM\Column(name="job_post_id", type="bigint", nullable=false)
     */
    private $jobPostId;

    /**
     * @var integer
     *
     * @ORM\Column(name="job_status", type="integer", nullable=true)
     */
    private $jobStatus = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="job_sent", type="bigint", nullable=true)
     */
    private $jobSent = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="job_failed", type="bigint", nullable=true)
     */
    private $jobFailed = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="job_total", type="bigint", nullable=true)
     */
    private $jobTotal = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="job_start", type="datetime", nullable=false)
     */
    private $jobStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="job_finish", type="datetime", nullable=false)
     */
    private $jobFinish;



    /**
     * Get jobId
     *
     * @return integer
     */
    public function getJobId()
    {
        return $this->jobId;
    }

    /**
     * Set jobPostId
     *
     * @param integer $jobPostId
     *
     * @return WpWpmJobs
     */
    public function setJobPostId($jobPostId)
    {
        $this->jobPostId = $jobPostId;

        return $this;
    }

    /**
     * Get jobPostId
     *
     * @return integer
     */
    public function getJobPostId()
    {
        return $this->jobPostId;
    }

    /**
     * Set jobStatus
     *
     * @param integer $jobStatus
     *
     * @return WpWpmJobs
     */
    public function setJobStatus($jobStatus)
    {
        $this->jobStatus = $jobStatus;

        return $this;
    }

    /**
     * Get jobStatus
     *
     * @return integer
     */
    public function getJobStatus()
    {
        return $this->jobStatus;
    }

    /**
     * Set jobSent
     *
     * @param integer $jobSent
     *
     * @return WpWpmJobs
     */
    public function setJobSent($jobSent)
    {
        $this->jobSent = $jobSent;

        return $this;
    }

    /**
     * Get jobSent
     *
     * @return integer
     */
    public function getJobSent()
    {
        return $this->jobSent;
    }

    /**
     * Set jobFailed
     *
     * @param integer $jobFailed
     *
     * @return WpWpmJobs
     */
    public function setJobFailed($jobFailed)
    {
        $this->jobFailed = $jobFailed;

        return $this;
    }

    /**
     * Get jobFailed
     *
     * @return integer
     */
    public function getJobFailed()
    {
        return $this->jobFailed;
    }

    /**
     * Set jobTotal
     *
     * @param integer $jobTotal
     *
     * @return WpWpmJobs
     */
    public function setJobTotal($jobTotal)
    {
        $this->jobTotal = $jobTotal;

        return $this;
    }

    /**
     * Get jobTotal
     *
     * @return integer
     */
    public function getJobTotal()
    {
        return $this->jobTotal;
    }

    /**
     * Set jobStart
     *
     * @param \DateTime $jobStart
     *
     * @return WpWpmJobs
     */
    public function setJobStart($jobStart)
    {
        $this->jobStart = $jobStart;

        return $this;
    }

    /**
     * Get jobStart
     *
     * @return \DateTime
     */
    public function getJobStart()
    {
        return $this->jobStart;
    }

    /**
     * Set jobFinish
     *
     * @param \DateTime $jobFinish
     *
     * @return WpWpmJobs
     */
    public function setJobFinish($jobFinish)
    {
        $this->jobFinish = $jobFinish;

        return $this;
    }

    /**
     * Get jobFinish
     *
     * @return \DateTime
     */
    public function getJobFinish()
    {
        return $this->jobFinish;
    }
}

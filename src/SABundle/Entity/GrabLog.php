<?php

namespace SABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrabLog
 *
 * @ORM\Table(name="grab_log")
 * @ORM\Entity(repositoryClass="SABundle\Repository\GrabLogRepository")
 */
class GrabLog
{
    /**
     * @ORM\ManyToOne(targetEntity="GrabRule", inversedBy="grabLogs")
     * @ORM\JoinColumn(name="grab_rule_id", referencedColumnName="id")
     */
    private $grabRule;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="grab_rule_id", type="integer")
     */
    private $grabRuleId;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="date")
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="time")
     */
    private $createTime;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_success", type="boolean")
     */
    private $isSuccess;

    /**
     * @var string
     *
     * @ORM\Column(name="exception", type="text", nullable=true)
     */
    private $exception;


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
     * Set grabRuleId
     *
     * @param integer $grabRuleId
     *
     * @return GrabLog
     */
    public function setGrabRuleId($grabRuleId)
    {
        $this->grabRuleId = $grabRuleId;

        return $this;
    }

    /**
     * Get grabRuleId
     *
     * @return int
     */
    public function getGrabRuleId()
    {
        return $this->grabRuleId;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return GrabLog
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return GrabLog
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     *
     * @return GrabLog
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set isSuccess
     *
     * @param boolean $isSuccess
     *
     * @return GrabLog
     */
    public function setIsSuccess($isSuccess)
    {
        $this->isSuccess = $isSuccess;

        return $this;
    }

    /**
     * Get isSuccess
     *
     * @return bool
     */
    public function getIsSuccess()
    {
        return $this->isSuccess;
    }

    /**
     * Set exception
     *
     * @param string $exception
     *
     * @return GrabLog
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


    /**
     * Set grabRule
     *
     * @param \SABundle\Entity\GrabRule $grabRule
     *
     * @return GrabLog
     */
    public function setGrabRule(\SABundle\Entity\GrabRule $grabRule = null)
    {
        $this->grabRule = $grabRule;

        return $this;
    }

    /**
     * Get grabRule
     *
     * @return \SABundle\Entity\GrabRule
     */
    public function getGrabRule()
    {
        return $this->grabRule;
    }

    public function setGrabLogException(\Exception $e){
        $this->setIsSuccess(false);
        $this->setCount(0);
        $this->setException($e->getMessage());
        return $this;
    }
}

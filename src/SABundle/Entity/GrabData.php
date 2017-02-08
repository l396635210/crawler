<?php

namespace SABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrabData
 *
 * @ORM\Table(name="grab_data")
 * @ORM\Entity(repositoryClass="SABundle\Repository\GrabDataRepository")
 */
class GrabData
{
    const PUSH_STATUS_NOT = 1;
    const PUSH_STATUS_PUSHED = 2;

    /**
     * @ORM\ManyToOne(targetEntity="GrabRule", inversedBy="grabDatas")
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
     * @var string
     *
     * @ORM\Column(name="data", type="text")
     */
    private $data;

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
     * @var int
     *
     * @ORM\Column(name="grab_rule_id", type="integer", nullable=true)
     */
    private $grabRuleId;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status=1;

    /**
     * @var int
     *
     * @ORM\Column(name="push_result", type="text", nullable=true)
     */
    private $pushResult;

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
     * Set data
     *
     * @param string $data
     *
     * @return GrabData
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    public function getParsedData($assoc=false){
        return \GuzzleHttp\json_decode($this->data,$assoc);
    }

    public function getGrabData(){
        $data = $this->getParsedData(true);
        if(isset($data[0])){
            $data = array_merge($data, $data[0]);
            unset($data[0]);
        }
        return $data;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return GrabData
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
     * @return GrabData
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
     * Set grabRuleId
     *
     * @param integer $grabRuleId
     *
     * @return GrabData
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
     * Set status
     *
     * @param integer $status
     *
     * @return GrabData
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
     * Set grabRule
     *
     * @param \SABundle\Entity\GrabRule $grabRule
     *
     * @return GrabData
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


    /**
     * Set pushResult
     *
     * @param string $pushResult
     *
     * @return GrabData
     */
    public function setPushResult($pushResult)
    {
        $this->pushResult = $pushResult;

        return $this;
    }

    /**
     * Get pushResult
     *
     * @return string
     */
    public function getPushResult()
    {
        return $this->pushResult;
    }
}

<?php

namespace CompaniesBundle\Entity;

/**
 * Area
 */
class Area
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $parentId;

    /**
     * @var integer
     */
    private $status = '1';

    /**
     * @var integer
     */
    private $orderNum = '0';

    /**
     * @var integer
     */
    private $isHot = '0';


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
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return Area
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Area
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
     * Set orderNum
     *
     * @param integer $orderNum
     *
     * @return Area
     */
    public function setOrderNum($orderNum)
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    /**
     * Get orderNum
     *
     * @return integer
     */
    public function getOrderNum()
    {
        return $this->orderNum;
    }

    /**
     * Set isHot
     *
     * @param integer $isHot
     *
     * @return Area
     */
    public function setIsHot($isHot)
    {
        $this->isHot = $isHot;

        return $this;
    }

    /**
     * Get isHot
     *
     * @return integer
     */
    public function getIsHot()
    {
        return $this->isHot;
    }
}


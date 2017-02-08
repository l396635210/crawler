<?php

namespace CompaniesBundle\Entity;

/**
 * CategoryType
 */
class CategoryType
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $status = '1';

    /**
     * @var integer
     */
    private $orderNum = '0';


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
     * Set status
     *
     * @param integer $status
     *
     * @return CategoryType
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
     * @return CategoryType
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
}


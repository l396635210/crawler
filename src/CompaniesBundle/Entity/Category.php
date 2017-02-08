<?php

namespace CompaniesBundle\Entity;

/**
 * Category
 */
class Category
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
    private $categoryTypeId = '0';


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
     * @return Category
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
     * @return Category
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
     * @return Category
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
     * Set categoryTypeId
     *
     * @param integer $categoryTypeId
     *
     * @return Category
     */
    public function setCategoryTypeId($categoryTypeId)
    {
        $this->categoryTypeId = $categoryTypeId;

        return $this;
    }

    /**
     * Get categoryTypeId
     *
     * @return integer
     */
    public function getCategoryTypeId()
    {
        return $this->categoryTypeId;
    }
}


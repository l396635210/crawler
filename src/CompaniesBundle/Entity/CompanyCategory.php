<?php

namespace CompaniesBundle\Entity;

/**
 * CompanyCategory
 */
class CompanyCategory
{
    /**
     * @var integer
     */
    private $companyId;

    /**
     * @var integer
     */
    private $categoryId;


    /**
     * Set companyId
     *
     * @param integer $companyId
     *
     * @return CompanyCategory
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
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return CompanyCategory
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }
}


<?php

namespace CompaniesBundle\Entity;

/**
 * CompanyArea
 */
class CompanyArea
{
    /**
     * @var integer
     */
    private $companyId;

    /**
     * @var integer
     */
    private $areaId;


    /**
     * Set companyId
     *
     * @param integer $companyId
     *
     * @return CompanyArea
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
     * Set areaId
     *
     * @param integer $areaId
     *
     * @return CompanyArea
     */
    public function setAreaId($areaId)
    {
        $this->areaId = $areaId;

        return $this;
    }

    /**
     * Get areaId
     *
     * @return integer
     */
    public function getAreaId()
    {
        return $this->areaId;
    }
}


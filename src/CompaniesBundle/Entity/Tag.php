<?php

namespace CompaniesBundle\Entity;

/**
 * Tag
 */
class Tag
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $status = '1';

    /**
     * @var integer
     */
    private $isHot = '0';

    /**
     * @var integer
     */
    private $languageId;

    /**
     * @var integer
     */
    private $companyCount = '0';


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
     * Set name
     *
     * @param string $name
     *
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Tag
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
     * Set isHot
     *
     * @param integer $isHot
     *
     * @return Tag
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

    /**
     * Set languageId
     *
     * @param integer $languageId
     *
     * @return Tag
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * Get languageId
     *
     * @return integer
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * Set companyCount
     *
     * @param integer $companyCount
     *
     * @return Tag
     */
    public function setCompanyCount($companyCount)
    {
        $this->companyCount = $companyCount;

        return $this;
    }

    /**
     * Get companyCount
     *
     * @return integer
     */
    public function getCompanyCount()
    {
        return $this->companyCount;
    }
}


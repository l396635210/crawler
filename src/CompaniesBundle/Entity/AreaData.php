<?php

namespace CompaniesBundle\Entity;

/**
 * AreaData
 */
class AreaData
{
    /**
     * @var integer
     */
    private $areaId;

    /**
     * @var integer
     */
    private $languageId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;


    /**
     * Set areaId
     *
     * @param integer $areaId
     *
     * @return AreaData
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

    /**
     * Set languageId
     *
     * @param integer $languageId
     *
     * @return AreaData
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
     * Set name
     *
     * @param string $name
     *
     * @return AreaData
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
     * Set description
     *
     * @param string $description
     *
     * @return AreaData
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}


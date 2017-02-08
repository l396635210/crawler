<?php

namespace CompaniesBundle\Entity;

/**
 * CategoryTypeData
 */
class CategoryTypeData
{
    /**
     * @var integer
     */
    private $categoryTypeId;

    /**
     * @var integer
     */
    private $languageId;

    /**
     * @var string
     */
    private $name;


    /**
     * Set categoryTypeId
     *
     * @param integer $categoryTypeId
     *
     * @return CategoryTypeData
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

    /**
     * Set languageId
     *
     * @param integer $languageId
     *
     * @return CategoryTypeData
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
     * @return CategoryTypeData
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
}


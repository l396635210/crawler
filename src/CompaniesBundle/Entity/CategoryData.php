<?php

namespace CompaniesBundle\Entity;

/**
 * CategoryData
 */
class CategoryData
{
    /**
     * @var integer
     */
    private $categoryId;

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
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return CategoryData
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

    /**
     * Set languageId
     *
     * @param integer $languageId
     *
     * @return CategoryData
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
     * @return CategoryData
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
     * @return CategoryData
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


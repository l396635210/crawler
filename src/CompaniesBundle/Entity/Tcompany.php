<?php

namespace CompaniesBundle\Entity;

/**
 * Tcompany
 */
class Tcompany
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $countryId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $siteurl;

    /**
     * @var integer
     */
    private $status = '1';


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
     * Set countryId
     *
     * @param integer $countryId
     *
     * @return Tcompany
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId
     *
     * @return integer
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tcompany
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
     * Set siteurl
     *
     * @param string $siteurl
     *
     * @return Tcompany
     */
    public function setSiteurl($siteurl)
    {
        $this->siteurl = $siteurl;

        return $this;
    }

    /**
     * Get siteurl
     *
     * @return string
     */
    public function getSiteurl()
    {
        return $this->siteurl;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Tcompany
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
}


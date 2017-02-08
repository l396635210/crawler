<?php

namespace CompaniesBundle\Entity;

/**
 * Tcountry
 */
class Tcountry
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $areaId;

    /**
     * @var string
     */
    private $name;

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
     * Set areaId
     *
     * @param integer $areaId
     *
     * @return Tcountry
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
     * Set name
     *
     * @param string $name
     *
     * @return Tcountry
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
     * @return Tcountry
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


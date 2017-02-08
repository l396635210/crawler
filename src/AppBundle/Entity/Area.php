<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Area
 *
 * @ORM\Table(name="area")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AreaRepository")
 */
class Area
{
    /**
     * @ORM\OneToMany(targetEntity="Company", mappedBy="area")
     */
    private $companies;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="area_name", type="string", length=50)
     */
    private $areaName;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", length=1)
     */
    private $status;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set areaName
     *
     * @param string $areaName
     *
     * @return Area
     */
    public function setAreaName($areaName)
    {
        $this->areaName = $areaName;

        return $this;
    }

    /**
     * Get areaName
     *
     * @return string
     */
    public function getAreaName()
    {
        return $this->areaName;
    }


    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Area
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->companies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return Area
     */
    public function addCompany(\AppBundle\Entity\Company $company)
    {
        $this->companies[] = $company;

        return $this;
    }

    /**
     * Remove company
     *
     * @param \AppBundle\Entity\Company $company
     */
    public function removeCompany(\AppBundle\Entity\Company $company)
    {
        $this->companies->removeElement($company);
    }

    /**
     * Get companies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompanies()
    {
        return $this->companies;
    }
}

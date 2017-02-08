<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Area;
/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 */
class Country
{

    /**
     * @ORM\OneToMany(targetEntity="Company", mappedBy="country")
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
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="companies")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    private $area;

    /**
     * @var int
     *
     * @ORM\Column(name="area_id", type="integer")
     */
    private $areaId;

    /**
     * @var string
     *
     * @ORM\Column(name="country_name", type="string", length=50, unique=true)
     */
    private $countryName;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", length=1)
     */
    private $status;

    public function __construct()
    {
        $this->company = new ArrayCollection();
    }

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
     * Set areaId
     *
     * @param integer $areaId
     *
     * @return Country
     */
    public function setAreaId($areaId)
    {
        $this->areaId = $areaId;
        return $this;
    }

    /**
     * Get areaId
     *
     * @return int
     */
    public function getAreaId()
    {
        return $this->areaId;
    }

    /**
     * Set countryName
     *
     * @param string $countryName
     *
     * @return Country
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * set area
     *
     * @return Country
     */
    public function setArea(Area $area)
    {
        $this->area = $area;
        $this->areaId = $area->getId();
        return $this;
    }

    /**
     * Get area
     *
     * @return Area
     */
    public function getArea()
    {
        return $this->area;
    }


    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Country
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
     * Add company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return Country
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

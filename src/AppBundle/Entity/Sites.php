<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sites
 *
 * @ORM\Table(name="sites")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SitesRepository")
 */
class Sites
{

    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="sites")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="company_id", type="integer")
     */
    private $companyId;

    /**
     * @var string
     *
     * @ORM\Column(name="site_url", type="string", length=255)
     */
    private $siteUrl;
    
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
     * Set companyId
     *
     * @param integer $companyId
     *
     * @return Sites
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set siteUrl
     *
     * @param string $siteUrl
     *
     * @return Sites
     */
    public function setSiteUrl($siteUrl)
    {
        $this->siteUrl = $siteUrl;

        return $this;
    }

    /**
     * Get siteUrl
     *
     * @return string
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return Sites
     */
    public function setCompany(\AppBundle\Entity\Company $company = null)
    {
        $this->company = $company;
        $this->companyId = $company->getId();
        return $this;
    }

    /**
     * Get company
     *
     * @return \AppBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }
}

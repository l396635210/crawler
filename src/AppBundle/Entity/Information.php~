<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Information
 *
 * @ORM\Table(name="information")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InformationRepository")
 */
class Information
{
    /**
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="infomations")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     */
    private $site;

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255, nullable=true)
     */
    private $source;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="getDate", type="date")
     */
    private $getDate;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var int
     *
     * @ORM\Column(name="site_id", type="integer")
     */
    private $siteId;



    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="string", length=255, nullable=true)
     */
    private $remarks;


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
     * Set title
     *
     * @param string $title
     *
     * @return Information
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Information
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return Information
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set getDate
     *
     * @param \DateTime $getDate
     *
     * @return Information
     */
    public function setGetDate($getDate)
    {
        $this->getDate = $getDate;

        return $this;
    }

    /**
     * Get getDate
     *
     * @return \DateTime
     */
    public function getGetDate()
    {
        return $this->getDate;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Information
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set siteId
     *
     * @param integer $siteId
     *
     * @return Information
     */
    public function setSiteId($siteId)
    {
        $this->siteId = $siteId;

        return $this;
    }

    /**
     * Get siteId
     *
     * @return int
     */
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * Set setSite
     *
     * @param Site $site
     *
     * @return Information
     */
    public function setSite(Site $site)
    {
        $this->site = $site;
        $this->siteId = $site->getId();
        return $this;
    }

    /**
     * Get getSite
     *
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Information
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Information
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }
}

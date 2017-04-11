<?php

namespace ReportBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 * @ORM\Table(name="report_channel")
 * @ORM\Entity(repositoryClass="ReportBundle\Repository\ChannelRepository")
 */
class Channel
{

    const LOGIC_NAME = "ReportBundle:Channel";

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Report", mappedBy="channel")
     */
    private $reports;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="channels")
     */
    private $category;

    /**
     * @var Site
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="channels")
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

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
     * Set name
     *
     * @param string $name
     *
     * @return Channel
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
     * Set url
     *
     * @param string $url
     *
     * @return Channel
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set category
     *
     * @param \ReportBundle\Entity\Category $category
     *
     * @return Channel
     */
    public function setCategory(\ReportBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \ReportBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set site
     *
     * @param \ReportBundle\Entity\Site $site
     *
     * @return Channel
     */
    public function setSite(\ReportBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \ReportBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reports = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add report
     *
     * @param \ReportBundle\Entity\Report $report
     *
     * @return Channel
     */
    public function addReport(\ReportBundle\Entity\Report $report)
    {
        $this->reports[] = $report;

        return $this;
    }

    /**
     * Remove report
     *
     * @param \ReportBundle\Entity\Report $report
     */
    public function removeReport(\ReportBundle\Entity\Report $report)
    {
        $this->reports->removeElement($report);
    }

    /**
     * Get reports
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReports()
    {
        return $this->reports;
    }
}

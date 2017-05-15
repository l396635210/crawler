<?php

namespace ReportBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 *
 * @ORM\Table(name="report_site")
 * @ORM\Entity(repositoryClass="ReportBundle\Repository\SiteRepository")
 */
class Site
{

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Channel", mappedBy="site")
     */
    private $channels;

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
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     */
    private $url;

    /**
     * @var boolean
     * @ORM\Column(name="can_grab", type="boolean")
     */
    private $canGrab;

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
     * @return Site
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
     * @return Site
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
     * Constructor
     */
    public function __construct()
    {
        $this->channels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->canGrab = true;
    }

    /**
     * Add channel
     *
     * @param \ReportBundle\Entity\Channel $channel
     *
     * @return Site
     */
    public function addChannel(\ReportBundle\Entity\Channel $channel)
    {
        $this->channels[] = $channel;

        return $this;
    }

    /**
     * Remove channel
     *
     * @param \ReportBundle\Entity\Channel $channel
     */
    public function removeChannel(\ReportBundle\Entity\Channel $channel)
    {
        $this->channels->removeElement($channel);
    }

    /**
     * Get channels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * Set canGrab
     *
     * @param boolean $canGrab
     *
     * @return Site
     */
    public function setCanGrab($canGrab)
    {
        $this->canGrab = $canGrab;

        return $this;
    }

    /**
     * Get canGrab
     *
     * @return boolean
     */
    public function getCanGrab()
    {
        return $this->canGrab;
    }
}

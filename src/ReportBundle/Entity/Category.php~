<?php

namespace ReportBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="report_category")
 * @ORM\Entity(repositoryClass="ReportBundle\Repository\CategoryRepository")
 */
class Category
{

    public function __toString()
    {
        $str = "";
        if($this->parent){
            $str .= $this->parent.'-';
        }
        return $str.$this->getName();
    }

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Channel", mappedBy="category")
     */
    private $channels;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    private $children;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     */
    private $parent;

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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;


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
     * @return Category
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
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add child
     *
     * @param \ReportBundle\Entity\Category $child
     *
     * @return Category
     */
    public function addChild(\ReportBundle\Entity\Category $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \ReportBundle\Entity\Category $child
     */
    public function removeChild(\ReportBundle\Entity\Category $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \ReportBundle\Entity\Category $parent
     *
     * @return Category
     */
    public function setParent(\ReportBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \ReportBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add channel
     *
     * @param \ReportBundle\Entity\Channel $channel
     *
     * @return Category
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
}

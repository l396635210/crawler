<?php

namespace ZhanhuiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table(name="zh_area")
 * @ORM\Entity(repositoryClass="ZhanhuiBundle\Repository\AreaRepository")
 */
class Area
{
    /**
     * One Area Has Many channels
     * @ORM\OneToMany(targetEntity="Channel", mappedBy="area")
     */
    private $channels;

    /**
     * One Category has Many Categories.
     * @ORM\OneToMany(targetEntity="Area", mappedBy="parent")
     */
    private $children;

    /**
     * Many Categories have One Category.
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="children")
     * @ORM\JoinColumn(name="p_id", referencedColumnName="id")
     */
    private $parent;

    public function __toString()
    {
        return $this->name;
    }

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
     * @ORM\Column(name="p_id", type="integer", nullable=true)
     */
    private $pId;

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
     * @return Area
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
     * Set pId
     *
     * @param integer $pId
     *
     * @return Area
     */
    public function setPId($pId)
    {
        $this->pId = $pId;

        return $this;
    }

    /**
     * Get pId
     *
     * @return integer
     */
    public function getPId()
    {
        return $this->pId;
    }

    /**
     * Add child
     *
     * @param \ZhanhuiBundle\Entity\Area $child
     *
     * @return Area
     */
    public function addChild(\ZhanhuiBundle\Entity\Area $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \ZhanhuiBundle\Entity\Area $child
     */
    public function removeChild(\ZhanhuiBundle\Entity\Area $child)
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
     * @param \ZhanhuiBundle\Entity\Area $parent
     *
     * @return Area
     */
    public function setParent(\ZhanhuiBundle\Entity\Area $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \ZhanhuiBundle\Entity\Area
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add channel
     *
     * @param \ZhanhuiBundle\Entity\Channel $channel
     *
     * @return Area
     */
    public function addChannel(\ZhanhuiBundle\Entity\Channel $channel)
    {
        $this->channels[] = $channel;

        return $this;
    }

    /**
     * Remove channel
     *
     * @param \ZhanhuiBundle\Entity\Channel $channel
     */
    public function removeChannel(\ZhanhuiBundle\Entity\Channel $channel)
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

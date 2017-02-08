<?php

namespace QABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QAList
 *
 * @ORM\Table(name="qa_list")
 * @ORM\Entity(repositoryClass="QABundle\Repository\QAListRepository")
 */
class QAList
{
    /**
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="qaList")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="qaList")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     */
    private $tag;

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
     * @var int
     *
     * @ORM\Column(name="site_id", type="integer")
     */
    private $siteId;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="tag_id", type="integer")
     */
    private $tagId;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", nullable=true)
     */
    private $data;


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
     * @return QAList
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
        return $this->name ? $this->name : $this->getSite()->getName()."-".$this->getTag()->getName();
    }

    /**
     * Set siteId
     *
     * @param integer $siteId
     *
     * @return QAList
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
     * Set status
     *
     * @param boolean $status
     *
     * @return QAList
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
     * Set tagId
     *
     * @param integer $tagId
     *
     * @return QAList
     */
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;

        return $this;
    }

    /**
     * Get tagId
     *
     * @return int
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return QAList
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set site
     *
     * @param \QABundle\Entity\Site $site
     *
     * @return QAList
     */
    public function setSite(\QABundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \QABundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set tag
     *
     * @param \QABundle\Entity\Tag $tag
     *
     * @return QAList
     */
    public function setTag(\QABundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \QABundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }


}

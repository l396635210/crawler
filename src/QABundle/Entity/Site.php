<?php

namespace QABundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use QABundle\Entity\QAList;
/**
 * Site
 *
 * @ORM\Table(name="qa_site")
 * @ORM\Entity(repositoryClass="QABundle\Repository\SiteRepository")
 */
class Site
{
    /**
     * @ORM\OneToMany(targetEntity="QAList", mappedBy="site")
     */
    private $qaList;

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
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", length=255, unique=true)
     */
    private $host;

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
     * Set status
     *
     * @param boolean $status
     *
     * @return Site
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
     * Set host
     *
     * @param string $host
     *
     * @return Site
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return Site
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
     * Constructor
     */
    public function __construct()
    {
        $this->qaList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add qaList
     *
     * @param \QABundle\Entity\QAList $qaList
     *
     * @return Site
     */
    public function addQaList(\QABundle\Entity\QAList $qaList)
    {
        $this->qaList[] = $qaList;

        return $this;
    }

    /**
     * Remove qaList
     *
     * @param \QABundle\Entity\QAList $qaList
     */
    public function removeQaList(\QABundle\Entity\QAList $qaList)
    {
        $this->qaList->removeElement($qaList);
    }

    /**
     * Get qaList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQaList()
    {
        return $this->qaList;
    }
}

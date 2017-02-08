<?php

namespace QABundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// DON'T forget this use statement!!!
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use QABundle\Entity\QAList;
/**
 * Tag
 *
 * @ORM\Table(name="qa_tag")
 * @ORM\Entity(repositoryClass="QABundle\Repository\TagRepository")
 * @UniqueEntity(
 *     fields = "name",
 *     message = "该名称已存在"
 * )
 */
class Tag
{
    /**
     * @ORM\OneToMany(targetEntity="QAList", mappedBy="tag")
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
     * @return Tag
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
     * @return Tag
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
     * Set data
     *
     * @param string $data
     *
     * @return Tag
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
     * @return Tag
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

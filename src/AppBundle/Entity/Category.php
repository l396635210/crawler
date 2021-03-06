<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\OneToMany(targetEntity="Site", mappedBy="category")
     */
    private $sites;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="categories")
     * @ORM\JoinColumn(name="update_uid", referencedColumnName="id")
     */
    private $updateUser;

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
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="date")
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="date")
     */
    private $updateDate;

    /**
     * @var int
     *
     * @ORM\Column(name="create_uid", type="integer")
     */
    private $createUid;

    /**
     * @var int
     *
     * @ORM\Column(name="update_uid", type="integer")
     */
    private $updateUid;


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
     * Set status
     *
     * @param boolean $status
     *
     * @return Category
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
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return Category
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     *
     * @return Category
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set createUid
     *
     * @param integer $createUid
     *
     * @return Category
     */
    public function setCreateUid($createUid)
    {
        $this->createUid = $createUid;

        return $this;
    }

    /**
     * Get createUid
     *
     * @return int
     */
    public function getCreateUid()
    {
        return $this->createUid;
    }

    /**
     * Set updateUid
     *
     * @param integer $updateUid
     *
     * @return Category
     */
    public function setUpdateUid($updateUid)
    {
        $this->updateUid = $updateUid;

        return $this;
    }

    /**
     * Get updateUid
     *
     * @return int
     */
    public function getUpdateUid()
    {
        return $this->updateUid;
    }



    /**
     * Set updateUser
     *
     * @param \AppBundle\Entity\User $updateUser
     *
     * @return Category
     */
    public function setUpdateUser(\AppBundle\Entity\User $updateUser = null)
    {
        $this->updateUser = $updateUser;

        return $this;
    }

    /**
     * Get updateUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getUpdateUser()
    {
        return $this->updateUser;
    }

    public function setInsert(User $user){
        $this->setStatus(true);
        $this->setCreateDate(new \DateTime());
        $this->setUpdateDate(new \DateTime());
        $this->setCreateUid($user->getId());
        $this->setUpdateUser($user);
    }

    public function setUpdate(User $user){
        $this->setUpdateDate(new \DateTime());
        $this->setUpdateUser($user);
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sites = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add site
     *
     * @param \AppBundle\Entity\Site $site
     *
     * @return Category
     */
    public function addSite(\AppBundle\Entity\Site $site)
    {
        $this->sites[] = $site;

        return $this;
    }

    /**
     * Remove site
     *
     * @param \AppBundle\Entity\Site $site
     */
    public function removeSite(\AppBundle\Entity\Site $site)
    {
        $this->sites->removeElement($site);
    }

    /**
     * Get sites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSites()
    {
        return $this->sites;
    }
}

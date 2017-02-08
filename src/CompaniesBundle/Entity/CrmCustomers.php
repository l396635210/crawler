<?php

namespace CompaniesBundle\Entity;

/**
 * CrmCustomers
 */
class CrmCustomers
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $business;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $note;

    /**
     * @var \DateTime
     */
    private $createtime;

    /**
     * @var string
     */
    private $companyType;

    /**
     * @var string
     */
    private $companyOverseasAbility;

    /**
     * @var string
     */
    private $companyScale;

    /**
     * @var string
     */
    private $companyCapital;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return CrmCustomers
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set business
     *
     * @param string $business
     *
     * @return CrmCustomers
     */
    public function setBusiness($business)
    {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return string
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CrmCustomers
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
     * Set email
     *
     * @param string $email
     *
     * @return CrmCustomers
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return CrmCustomers
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return CrmCustomers
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set createtime
     *
     * @param \DateTime $createtime
     *
     * @return CrmCustomers
     */
    public function setCreatetime($createtime)
    {
        $this->createtime = $createtime;

        return $this;
    }

    /**
     * Get createtime
     *
     * @return \DateTime
     */
    public function getCreatetime()
    {
        return $this->createtime;
    }

    /**
     * Set companyType
     *
     * @param string $companyType
     *
     * @return CrmCustomers
     */
    public function setCompanyType($companyType)
    {
        $this->companyType = $companyType;

        return $this;
    }

    /**
     * Get companyType
     *
     * @return string
     */
    public function getCompanyType()
    {
        return $this->companyType;
    }

    /**
     * Set companyOverseasAbility
     *
     * @param string $companyOverseasAbility
     *
     * @return CrmCustomers
     */
    public function setCompanyOverseasAbility($companyOverseasAbility)
    {
        $this->companyOverseasAbility = $companyOverseasAbility;

        return $this;
    }

    /**
     * Get companyOverseasAbility
     *
     * @return string
     */
    public function getCompanyOverseasAbility()
    {
        return $this->companyOverseasAbility;
    }

    /**
     * Set companyScale
     *
     * @param string $companyScale
     *
     * @return CrmCustomers
     */
    public function setCompanyScale($companyScale)
    {
        $this->companyScale = $companyScale;

        return $this;
    }

    /**
     * Get companyScale
     *
     * @return string
     */
    public function getCompanyScale()
    {
        return $this->companyScale;
    }

    /**
     * Set companyCapital
     *
     * @param string $companyCapital
     *
     * @return CrmCustomers
     */
    public function setCompanyCapital($companyCapital)
    {
        $this->companyCapital = $companyCapital;

        return $this;
    }

    /**
     * Get companyCapital
     *
     * @return string
     */
    public function getCompanyCapital()
    {
        return $this->companyCapital;
    }
}


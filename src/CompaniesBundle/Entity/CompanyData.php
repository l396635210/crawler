<?php

namespace CompaniesBundle\Entity;

/**
 * CompanyData
 */
class CompanyData
{
    /**
     * @var integer
     */
    private $companyId;

    /**
     * @var integer
     */
    private $languageId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $telphone;

    /**
     * @var string
     */
    private $tax;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $business;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $linkUser;

    /**
     * @var string
     */
    private $linkTel;

    /**
     * @var string
     */
    private $linkEmail;

    /**
     * @var string
     */
    private $linkAddress;

    /**
     * @var integer
     */
    private $rank = '0';

    /**
     * @var integer
     */
    private $info = '0';


    /**
     * Set companyId
     *
     * @param integer $companyId
     *
     * @return CompanyData
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set languageId
     *
     * @param integer $languageId
     *
     * @return CompanyData
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * Get languageId
     *
     * @return integer
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CompanyData
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
     * Set telphone
     *
     * @param string $telphone
     *
     * @return CompanyData
     */
    public function setTelphone($telphone)
    {
        $this->telphone = $telphone;

        return $this;
    }

    /**
     * Get telphone
     *
     * @return string
     */
    public function getTelphone()
    {
        return $this->telphone;
    }

    /**
     * Set tax
     *
     * @param string $tax
     *
     * @return CompanyData
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax
     *
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return CompanyData
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set business
     *
     * @param string $business
     *
     * @return CompanyData
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
     * Set description
     *
     * @param string $description
     *
     * @return CompanyData
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return CompanyData
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
     * Set website
     *
     * @param string $website
     *
     * @return CompanyData
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set linkUser
     *
     * @param string $linkUser
     *
     * @return CompanyData
     */
    public function setLinkUser($linkUser)
    {
        $this->linkUser = $linkUser;

        return $this;
    }

    /**
     * Get linkUser
     *
     * @return string
     */
    public function getLinkUser()
    {
        return $this->linkUser;
    }

    /**
     * Set linkTel
     *
     * @param string $linkTel
     *
     * @return CompanyData
     */
    public function setLinkTel($linkTel)
    {
        $this->linkTel = $linkTel;

        return $this;
    }

    /**
     * Get linkTel
     *
     * @return string
     */
    public function getLinkTel()
    {
        return $this->linkTel;
    }

    /**
     * Set linkEmail
     *
     * @param string $linkEmail
     *
     * @return CompanyData
     */
    public function setLinkEmail($linkEmail)
    {
        $this->linkEmail = $linkEmail;

        return $this;
    }

    /**
     * Get linkEmail
     *
     * @return string
     */
    public function getLinkEmail()
    {
        return $this->linkEmail;
    }

    /**
     * Set linkAddress
     *
     * @param string $linkAddress
     *
     * @return CompanyData
     */
    public function setLinkAddress($linkAddress)
    {
        $this->linkAddress = $linkAddress;

        return $this;
    }

    /**
     * Get linkAddress
     *
     * @return string
     */
    public function getLinkAddress()
    {
        return $this->linkAddress;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     *
     * @return CompanyData
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set info
     *
     * @param integer $info
     *
     * @return CompanyData
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return integer
     */
    public function getInfo()
    {
        return $this->info;
    }
}


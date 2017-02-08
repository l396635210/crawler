<?php

namespace CompaniesBundle\Entity;

/**
 * Company
 */
class Company
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $defaultLangId;

    /**
     * @var integer
     */
    private $areaId1;

    /**
     * @var integer
     */
    private $areaId2;

    /**
     * @var integer
     */
    private $areaId3;

    /**
     * @var \DateTime
     */
    private $addtime;

    /**
     * @var \DateTime
     */
    private $modtime;

    /**
     * @var integer
     */
    private $status = '1';

    /**
     * @var string
     */
    private $logo;

    /**
     * @var string
     */
    private $license;

    /**
     * @var integer
     */
    private $licenseStatus;

    /**
     * @var string
     */
    private $licenseResult;

    /**
     * @var integer
     */
    private $capital;

    /**
     * @var integer
     */
    private $scale;

    /**
     * @var integer
     */
    private $userMode = '0';

    /**
     * @var integer
     */
    private $collectRank = '0';

    /**
     * @var \DateTime
     */
    private $lastActiveTime;

    /**
     * @var integer
     */
    private $licenseRank = '0';

    /**
     * @var \DateTime
     */
    private $checktime;

    /**
     * @var string
     */
    private $remark;

    /**
     * @var integer
     */
    private $languageRank1 = '0';

    /**
     * @var integer
     */
    private $languageRank2 = '0';

    /**
     * @var integer
     */
    private $languageInfo1 = '0';

    /**
     * @var integer
     */
    private $languageInfo2 = '0';

    /**
     * @var integer
     */
    private $vip = '0';

    /**
     * @var \DateTime
     */
    private $vipStartdate;

    /**
     * @var \DateTime
     */
    private $vipEnddate;


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
     * Set defaultLangId
     *
     * @param integer $defaultLangId
     *
     * @return Company
     */
    public function setDefaultLangId($defaultLangId)
    {
        $this->defaultLangId = $defaultLangId;

        return $this;
    }

    /**
     * Get defaultLangId
     *
     * @return integer
     */
    public function getDefaultLangId()
    {
        return $this->defaultLangId;
    }

    /**
     * Set areaId1
     *
     * @param integer $areaId1
     *
     * @return Company
     */
    public function setAreaId1($areaId1)
    {
        $this->areaId1 = $areaId1;

        return $this;
    }

    /**
     * Get areaId1
     *
     * @return integer
     */
    public function getAreaId1()
    {
        return $this->areaId1;
    }

    /**
     * Set areaId2
     *
     * @param integer $areaId2
     *
     * @return Company
     */
    public function setAreaId2($areaId2)
    {
        $this->areaId2 = $areaId2;

        return $this;
    }

    /**
     * Get areaId2
     *
     * @return integer
     */
    public function getAreaId2()
    {
        return $this->areaId2;
    }

    /**
     * Set areaId3
     *
     * @param integer $areaId3
     *
     * @return Company
     */
    public function setAreaId3($areaId3)
    {
        $this->areaId3 = $areaId3;

        return $this;
    }

    /**
     * Get areaId3
     *
     * @return integer
     */
    public function getAreaId3()
    {
        return $this->areaId3;
    }

    /**
     * Set addtime
     *
     * @param \DateTime $addtime
     *
     * @return Company
     */
    public function setAddtime($addtime)
    {
        $this->addtime = $addtime;

        return $this;
    }

    /**
     * Get addtime
     *
     * @return \DateTime
     */
    public function getAddtime()
    {
        return $this->addtime;
    }

    /**
     * Set modtime
     *
     * @param \DateTime $modtime
     *
     * @return Company
     */
    public function setModtime($modtime)
    {
        $this->modtime = $modtime;

        return $this;
    }

    /**
     * Get modtime
     *
     * @return \DateTime
     */
    public function getModtime()
    {
        return $this->modtime;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Company
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Company
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set license
     *
     * @param string $license
     *
     * @return Company
     */
    public function setLicense($license)
    {
        $this->license = $license;

        return $this;
    }

    /**
     * Get license
     *
     * @return string
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * Set licenseStatus
     *
     * @param integer $licenseStatus
     *
     * @return Company
     */
    public function setLicenseStatus($licenseStatus)
    {
        $this->licenseStatus = $licenseStatus;

        return $this;
    }

    /**
     * Get licenseStatus
     *
     * @return integer
     */
    public function getLicenseStatus()
    {
        return $this->licenseStatus;
    }

    /**
     * Set licenseResult
     *
     * @param string $licenseResult
     *
     * @return Company
     */
    public function setLicenseResult($licenseResult)
    {
        $this->licenseResult = $licenseResult;

        return $this;
    }

    /**
     * Get licenseResult
     *
     * @return string
     */
    public function getLicenseResult()
    {
        return $this->licenseResult;
    }

    /**
     * Set capital
     *
     * @param integer $capital
     *
     * @return Company
     */
    public function setCapital($capital)
    {
        $this->capital = $capital;

        return $this;
    }

    /**
     * Get capital
     *
     * @return integer
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * Set scale
     *
     * @param integer $scale
     *
     * @return Company
     */
    public function setScale($scale)
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * Get scale
     *
     * @return integer
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Set userMode
     *
     * @param integer $userMode
     *
     * @return Company
     */
    public function setUserMode($userMode)
    {
        $this->userMode = $userMode;

        return $this;
    }

    /**
     * Get userMode
     *
     * @return integer
     */
    public function getUserMode()
    {
        return $this->userMode;
    }

    /**
     * Set collectRank
     *
     * @param integer $collectRank
     *
     * @return Company
     */
    public function setCollectRank($collectRank)
    {
        $this->collectRank = $collectRank;

        return $this;
    }

    /**
     * Get collectRank
     *
     * @return integer
     */
    public function getCollectRank()
    {
        return $this->collectRank;
    }

    /**
     * Set lastActiveTime
     *
     * @param \DateTime $lastActiveTime
     *
     * @return Company
     */
    public function setLastActiveTime($lastActiveTime)
    {
        $this->lastActiveTime = $lastActiveTime;

        return $this;
    }

    /**
     * Get lastActiveTime
     *
     * @return \DateTime
     */
    public function getLastActiveTime()
    {
        return $this->lastActiveTime;
    }

    /**
     * Set licenseRank
     *
     * @param integer $licenseRank
     *
     * @return Company
     */
    public function setLicenseRank($licenseRank)
    {
        $this->licenseRank = $licenseRank;

        return $this;
    }

    /**
     * Get licenseRank
     *
     * @return integer
     */
    public function getLicenseRank()
    {
        return $this->licenseRank;
    }

    /**
     * Set checktime
     *
     * @param \DateTime $checktime
     *
     * @return Company
     */
    public function setChecktime($checktime)
    {
        $this->checktime = $checktime;

        return $this;
    }

    /**
     * Get checktime
     *
     * @return \DateTime
     */
    public function getChecktime()
    {
        return $this->checktime;
    }

    /**
     * Set remark
     *
     * @param string $remark
     *
     * @return Company
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get remark
     *
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Set languageRank1
     *
     * @param integer $languageRank1
     *
     * @return Company
     */
    public function setLanguageRank1($languageRank1)
    {
        $this->languageRank1 = $languageRank1;

        return $this;
    }

    /**
     * Get languageRank1
     *
     * @return integer
     */
    public function getLanguageRank1()
    {
        return $this->languageRank1;
    }

    /**
     * Set languageRank2
     *
     * @param integer $languageRank2
     *
     * @return Company
     */
    public function setLanguageRank2($languageRank2)
    {
        $this->languageRank2 = $languageRank2;

        return $this;
    }

    /**
     * Get languageRank2
     *
     * @return integer
     */
    public function getLanguageRank2()
    {
        return $this->languageRank2;
    }

    /**
     * Set languageInfo1
     *
     * @param integer $languageInfo1
     *
     * @return Company
     */
    public function setLanguageInfo1($languageInfo1)
    {
        $this->languageInfo1 = $languageInfo1;

        return $this;
    }

    /**
     * Get languageInfo1
     *
     * @return integer
     */
    public function getLanguageInfo1()
    {
        return $this->languageInfo1;
    }

    /**
     * Set languageInfo2
     *
     * @param integer $languageInfo2
     *
     * @return Company
     */
    public function setLanguageInfo2($languageInfo2)
    {
        $this->languageInfo2 = $languageInfo2;

        return $this;
    }

    /**
     * Get languageInfo2
     *
     * @return integer
     */
    public function getLanguageInfo2()
    {
        return $this->languageInfo2;
    }

    /**
     * Set vip
     *
     * @param integer $vip
     *
     * @return Company
     */
    public function setVip($vip)
    {
        $this->vip = $vip;

        return $this;
    }

    /**
     * Get vip
     *
     * @return integer
     */
    public function getVip()
    {
        return $this->vip;
    }

    /**
     * Set vipStartdate
     *
     * @param \DateTime $vipStartdate
     *
     * @return Company
     */
    public function setVipStartdate($vipStartdate)
    {
        $this->vipStartdate = $vipStartdate;

        return $this;
    }

    /**
     * Get vipStartdate
     *
     * @return \DateTime
     */
    public function getVipStartdate()
    {
        return $this->vipStartdate;
    }

    /**
     * Set vipEnddate
     *
     * @param \DateTime $vipEnddate
     *
     * @return Company
     */
    public function setVipEnddate($vipEnddate)
    {
        $this->vipEnddate = $vipEnddate;

        return $this;
    }

    /**
     * Get vipEnddate
     *
     * @return \DateTime
     */
    public function getVipEnddate()
    {
        return $this->vipEnddate;
    }
}


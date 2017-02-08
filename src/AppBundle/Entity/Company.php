<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Area;
use AppBundle\Entity\Country;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Company
 *
 * @ORM\Table(name="company", indexes={@ORM\Index(name="status_idx", columns={"status"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 */
class Company
{
    const AUTO = 1;
    const ARTI = 2;

    /**
     * @ORM\OneToMany(targetEntity="Tenders", mappedBy="company")
     */
    private $tenderss;

    protected $tenders = array();

    /**
     * @ORM\OneToMany(targetEntity="CrawlerLog", mappedBy="company")
     */
    private $crawlerLogs;

    /**
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="companies")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    private $area;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="companies")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="companies")
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
     * @var int
     *
     * @ORM\Column(name="area_id", type="integer")
     */
    private $areaId;

    /**
     * @var int
     *
     * @ORM\Column(name="country_id", type="integer")
     */
    private $countryId;

    /**
     * @var int
     *
     * @ORM\Column(name="update_uid", type="integer")
     */
    private $updateUId;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=255)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="company_site", type="string", columnDefinition="text NOT NULL")
     */
    private $companySite;

    /**
     * @var string
     *
     * @ORM\Column(name="select_rules", type="string", length=100, nullable=true)
     */
    private $selectRules;

    /**
     * @var string
     *
     * @ORM\Column(name="title_rules", type="string", length=100 , nullable=true)
     */
    private $titleRules;

    /**
     * @var string
     *
     * @ORM\Column(name="link_rules", type="string", length=100, nullable=true)
     */
    private $linkRules;

    /**
     * @var string
     * json格式：{"link":"linkPrefix","pdf":"pdfPrefix"}
     * @ORM\Column(name="prefix", type="string", length=255, nullable=true, options={"comment":"链接前缀"})
     */
    private $prefix;

    /**
     * @var string
     *
     * @ORM\Column(name="content_rules", type="string", length=100, nullable=true)
     */
    private $contentRules;

    /**
     * @var string
     * json {"tenderFields":"choiceRules"}
     * @ORM\Column(name="list_page_other_rules", type="string", nullable=true)
     */
    private $listPageOtherRules;

    /**
     * @var string
     * json {"tenderFields":"choiceRules"}
     * @ORM\Column(name="detail_page_rules", type="string", nullable=true)
     */
    private $detailPageRules;

    /**
     * @var string
     * @ORM\Column(name="content_is_pdf", type="boolean", nullable=true )
     */
    private $detailPageIsPDF;

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer")
     * @Assert\Range(
     *      min = 1,
     *      minMessage = "请输入一个正整数",
     * )
     */
    private $sort;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="smallint", length=1)
     */
    private $status;

    /**
     * @var bool
     *
     * @ORM\Column(name="push_status", type="boolean", length=1)
     */
    private $pushStatus=false;

    /**
     * @var bool
     *
     * @ORM\Column(name="isDesc", type="boolean", length=1)
     */
    private $isDesc=false;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_push", type="boolean", length=1)
     */
    private $isPush=true;

    /**
     * @var string
     *
     * @ORM\Column(name="cookie", type="string", length=500, nullable=true)
     */
    private $cookie;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="string", nullable=true)
     */
    private $remarks;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", nullable=true)
     */
    private $data;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="date")
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="time")
     */
    private $createTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="date")
     */
    private $updateDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="time")
     */
    private $updateTime;

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
     * Set areaId
     *
     * @param integer $areaId
     *
     * @return Company
     */
    public function setAreaId($areaId)
    {
        $this->areaId = $areaId;

        return $this;
    }

    /**
     * Get areaId
     *
     * @return int
     */
    public function getAreaId()
    {
        return $this->areaId;
    }

    /**
     * Set countryId
     *
     * @param integer $countryId
     *
     * @return Company
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId
     *
     * @return int
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Company
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
     * Set companySite
     *
     * @param string $companySite
     *
     * @return Company
     */
    public function setCompanySite($companySite)
    {
        $this->companySite = $companySite;

        return $this;
    }

    /**
     * Get companySite
     *
     * @return string
     */
    public function getCompanySite()
    {
        /*if($this->companySite)*/
            return $this->companySite;
    }

    public function getSitesArray(){
        return explode(',', $this->getCompanySite());
    }

    public function setArea(Area $area){
        $this->area = $area;
        $this->setAreaId($area->getId());
        return $this;
    }

    public function getArea(){
        return $this->area;
    }

    public function setCountry(Country $country){
        $this->country = $country;
        $this->setCountryId($country->getId());
        return $this;
    }

    public function getCountry(){
        return $this->country;
    }

    public function setSiteUrl($siteUrl){

    }
    public function getSiteUrl(){
        $siteList = $this->getSitesArray();
        return $siteList[0];
    }

    /**
     * Set selectRules
     *
     * @param string $selectRules
     *
     * @return Company
     */
    public function setSelectRules($selectRules)
    {
        $this->selectRules = $selectRules;

        return $this;
    }

    /**
     * Get selectRules
     *
     * @return string
     */
    public function getSelectRules()
    {
        return $this->selectRules;
    }
    

    /**
     * Set linkRules
     *
     * @param string $linkRules
     *
     * @return Company
     */
    public function setLinkRules($linkRules)
    {
        $this->linkRules = $linkRules;

        return $this;
    }

    /**
     * Get linkRules
     *
     * @return string
     */
    public function getLinkRules()
    {
        return $this->linkRules;
    }

    /**
     * Set contentRules
     *
     * @param string $contentRules
     *
     * @return Company
     */
    public function setContentRules($contentRules)
    {
        $this->contentRules = $contentRules;

        return $this;
    }

    /**
     * Get contentRules
     *
     * @return string
     */
    public function getContentRules()
    {
        return $this->contentRules;
    }

    /**
     * Set titleRules
     *
     * @param string $titleRules
     *
     * @return Company
     */
    public function setTitleRules($titleRules)
    {
        $this->titleRules = $titleRules;

        return $this;
    }

    /**
     * Get titleRules
     *
     * @return string
     */
    public function getTitleRules()
    {
        return $this->titleRules;
    }


    /**
     * Set status
     *
     * @param boolean $status
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
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set sort
     *
     * @param int $sort
     *
     * @return Company
     */
    public function setSort()
    {
        $sort = $this->areaId*1000000 + $this->countryId*1000;
        $this->sort = $this->id ? $sort+$this->id : $sort;
        return $this;
    }

    /**
     * Get sort
     *
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * add Tenders
     * @param Tenders $tenders
     *
     */
    public function addTenders(Tenders $tenders){
        array_unshift($this->tenders, $tenders);
        return $this;
    }

    public function getTenders(){
        return $this->tenders;
    }

    /**
     * Set cookie
     *
     * @param string $cookie
     *
     * @return Company
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;

        return $this;
    }

    /**
     * Get cookie
     *
     * @return string
     */
    public function getCookie()
    {
        return $this->cookie;
    }


    /**
     * Set isDesc
     *
     * @param boolean $isDesc
     *
     * @return Company
     */
    public function setIsDesc($isDesc)
    {
        $this->isDesc = $isDesc;

        return $this;
    }

    /**
     * Get isDesc
     *
     * @return boolean
     */
    public function getIsDesc()
    {
        return $this->isDesc;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Company
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    public function getStatusDesc(){
        return $this->status == self::AUTO ? '自动' : ($this->status==self::ARTI ? '手动' : '待定');
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return Company
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
     * Set createTime
     *
     * @param \DateTime $createTime
     *
     * @return Company
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set listPageOtherRules
     *
     * @param string $listPageOtherRules
     *
     * @return Company
     */
    public function setListPageOtherRules($listPageOtherRules)
    {
        $this->listPageOtherRules = $listPageOtherRules;

        return $this;
    }

    /**
     * Get listPageOtherRules
     *
     * @return string
     */
    public function getListPageOtherRules()
    {
        return $this->listPageOtherRules;
    }

    /**
     * Set detailPageRules
     *
     * @param string $detailPageRules
     *
     * @return Company
     */
    public function setDetailPageRules($detailPageRules)
    {
        $this->detailPageRules = $detailPageRules;

        return $this;
    }

    /**
     * Get detailPageRules
     *
     * @return string
     */
    public function getDetailPageRules()
    {
        return $this->detailPageRules;
    }

    /**
     * Set detailPageIsPDF
     *
     * @param boolean $detailPageIsPDF
     *
     * @return Company
     */
    public function setDetailPageIsPDF($detailPageIsPDF)
    {
        $this->detailPageIsPDF = $detailPageIsPDF;

        return $this;
    }

    /**
     * Get detailPageIsPDF
     *
     * @return boolean
     */
    public function getDetailPageIsPDF()
    {
        return $this->detailPageIsPDF;
    }

    /**
     * Set isPush
     *
     * @param boolean $isPush
     *
     * @return Company
     */
    public function setIsPush($isPush)
    {
        $this->isPush = $isPush;

        return $this;
    }

    /**
     * Get isPush
     *
     * @return boolean
     */
    public function getIsPush()
    {
        return $this->isPush;
    }

    /**
     * Set pushStatus
     *
     * @param boolean $pushStatus
     *
     * @return Company
     */
    public function setPushStatus($pushStatus)
    {
        $this->pushStatus = $pushStatus;

        return $this;
    }

    /**
     * Get pushStatus
     *
     * @return boolean
     */
    public function getPushStatus()
    {
        return $this->pushStatus;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return Company
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getPrefixObject(){
        $prefix = (object)[];
        if(trim($this->prefix)){
            $prefix = \GuzzleHttp\json_decode($this->prefix);
        }
        return $prefix;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     *
     * @return Company
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
     * Set updateTime
     *
     * @param \DateTime $updateTime
     *
     * @return Company
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Set updateUId
     *
     * @param integer $updateUId
     *
     * @return Company
     */
    public function setUpdateUId($updateUId)
    {
        $this->updateUId = $updateUId;

        return $this;
    }

    /**
     * Get updateUId
     *
     * @return integer
     */
    public function getUpdateUId()
    {
        return $this->updateUId;
    }

    /**
     * Set updateUser
     *
     * @param \AppBundle\Entity\User $updateUser
     *
     * @return Company
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tenderss = new \Doctrine\Common\Collections\ArrayCollection();
        $this->crawlerLogs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tenderss
     *
     * @param \AppBundle\Entity\Tenders $tenderss
     *
     * @return Company
     */
    public function addTenderss(\AppBundle\Entity\Tenders $tenderss)
    {
        $this->tenderss[] = $tenderss;

        return $this;
    }

    /**
     * Remove tenderss
     *
     * @param \AppBundle\Entity\Tenders $tenderss
     */
    public function removeTenderss(\AppBundle\Entity\Tenders $tenderss)
    {
        $this->tenderss->removeElement($tenderss);
    }

    /**
     * Get tenderss
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTenderss()
    {
        return $this->tenderss;
    }

    /**
     * Add crawlerLog
     *
     * @param \AppBundle\Entity\CrawlerLog $crawlerLog
     *
     * @return Company
     */
    public function addCrawlerLog(\AppBundle\Entity\CrawlerLog $crawlerLog)
    {
        $this->crawlerLogs[] = $crawlerLog;

        return $this;
    }

    /**
     * Remove crawlerLog
     *
     * @param \AppBundle\Entity\CrawlerLog $crawlerLog
     */
    public function removeCrawlerLog(\AppBundle\Entity\CrawlerLog $crawlerLog)
    {
        $this->crawlerLogs->removeElement($crawlerLog);
    }

    /**
     * Get crawlerLogs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCrawlerLogs()
    {
        return $this->crawlerLogs;
    }


    /**
     * Set data
     *
     * @param string $data
     *
     * @return Company
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

    public function getDataArr(){
        $data = [];
        if($this->data){
            $data = \GuzzleHttp\json_decode($this->data, true);
        }
        return $data;
    }

    public function getWithAgent(){
        $data = $this->getDataArr();
        if(isset($data["with_agent"])){
            $withAgent = $data["with_agent"];
        }else{
            $withAgent = false;
        }
        return $withAgent;
    }

    public function setWithAgent($withAgent){
        $data = $this->getDataArr();
        $data["with_agent"] = $withAgent;
        $this->data = \GuzzleHttp\json_encode($data);
        return $this;
    }
}

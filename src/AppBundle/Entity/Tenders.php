<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tenders
 *
 * @ORM\Table(name="tenders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TendersRepository")
 */
class Tenders
{
    const NUM_ITEMS = 20;

    const UNHANDLED = '0';
    const HANDLED   = '1';
    const UPDATED   = '2';
    const IGNORED   = '3';

    const PUSHED  = 2;
    const VALID   = 1;
    const INVALID = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="tenderss")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;
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
     * @ORM\Column(name="company_id", type="integer", options={"comment":"渠道id"})
     */
    private $companyId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", columnDefinition="text NOT NULL COMMENT '标题'")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true, options={"comment":"内容"})
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", nullable=true, options={"comment":"招标详情地址"})
     */
     private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", options={"comment":"抓取日期"})
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time", options={"comment":"抓取时间"})
     */
    private $time;

    /**
     * @var int
     *
     * @ORM\Column(name="tender_num", type="integer", options={"comment":"招标数量"})
     */
    private $tenderNum;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="text", nullable=true, options={"comment":"备注"})
     */
    private $remarks;

    /**
     * @var string
     *
     * @ORM\Column(name="cate", type="text", nullable=true, options={"comment":"招标分类"})
     */
    private $cate;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string",length=500, nullable=true, options={"comment":"招标编号"})
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="text", nullable=true, options={"comment":"pdf地址"})
     */
    private $pdf;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="text", nullable=true, options={"comment":"价钱"})
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_date", type="text", nullable=true, options={"comment":"发布日期"})
     */
    private $publishDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="string", nullable=true, options={"comment":"截标日期"})
     */
    private $endDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enterprise", type="string", nullable=true, options={"comment":"招标企业/国家"})
     */
    private $enterprise;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="integer", options={"comment":"状态：0-已删除，1-正常，2-已推送"})
     */
    private $status;

    /**
     * @var bool
     *
     * @ORM\Column(name="field1", type="string", nullable=true, options={"comment":"抓取字段1"})
     */
    private $field1;
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
     * Set companyId
     *
     * @param integer $companyId
     *
     * @return Tenders
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Tenders
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Tenders
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Tenders
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set tenderNum
     *
     * @param integer $tenderNum
     *
     * @return Tenders
     */
    public function setTenderNum($tenderNum)
    {
        $this->tenderNum = $tenderNum;

        return $this;
    }

    /**
     * Get tenderNum
     *
     * @return int
     */
    public function getTenderNum()
    {
        return $this->tenderNum;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Tenders
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        $url = $this->url;
        if($this->getCompany()&&!$url){
            $url = $this->getCompany()->getSitesArray()[0];
        }
        return $url;
    }
    

    /**
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return Tenders
     */
    public function setCompany(\AppBundle\Entity\Company $company = null)
    {
        $this->company = $company;
        $this->companyId = $company->getId();
        return $this;
    }

    /**
     * Get company
     *
     * @return \AppBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Tenders
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Tenders
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

    /**
     * Set cate
     *
     * @param string $cate
     *
     * @return Tenders
     */
    public function setCate($cate)
    {
        $this->cate = $cate;

        return $this;
    }

    /**
     * Get cate
     *
     * @return string
     */
    public function getCate()
    {
        return $this->cate;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Tenders
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set pdf
     *
     * @param string $pdf
     *
     * @return Tenders
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set publishDate
     *
     * @param string $publishDate
     *
     * @return Tenders
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * Get publishDate
     *
     * @return string
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * Set endDate
     *
     * @param string $endDate
     *
     * @return Tenders
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set enterprise
     *
     * @param string $enterprise
     *
     * @return Tenders
     */
    public function setEnterprise($enterprise)
    {
        $this->enterprise = $enterprise;

        return $this;
    }

    /**
     * Get enterprise
     *
     * @return string
     */
    public function getEnterprise()
    {
        return $this->enterprise;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Tenders
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

    public function getFilterCloseDate(){
        $closeDate = $this->endDate;
        if(stripos($closeDate, "Closing Date: ")===0){
            $closeDate = substr($this->endDate, strlen("Closing Date: "));
        }

        return $closeDate;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Tenders
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set field1
     *
     * @param string $field1
     *
     * @return Tenders
     */
    public function setField1($field1)
    {
        $this->field1 = $field1;

        return $this;
    }

    /**
     * Get field1
     *
     * @return string
     */
    public function getField1()
    {
        return $this->field1;
    }
}

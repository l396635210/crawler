<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site  资讯内容的信息渠道
 *
 * @ORM\Table(name="site")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SiteRepository")
 */
class Site
{
    const AUTO = 1;
    const ARTI = 2;

    const isPushCategory = 5;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="sites")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var int
     *
     * @ORM\Column(name="category_id", type="integer")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text")
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="select_rules", type="string", length=255, nullable=true)
     */
    private $selectRules;

    /**
     * @var string
     *
     * @ORM\Column(name="title_rules", type="string", length=255, nullable=true)
     */
    private $titleRules;

    /**
     * @var string
     *
     * @ORM\Column(name="link_rules", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="content_rules", type="string", length=255, nullable=true)
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
     *
     * @ORM\Column(name="source_rules", type="string", length=255, nullable=true)
     */
    private $sourceRules;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    private $urlShow;

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
     * Set url
     *
     * @param string $url
     *
     * @return Site
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
        return $this->url;
    }

    public function setUrlShow($urlShow){

    }

    public function getUrlShow($getOne=true){
        $urlArr = $this->getUrlArr();
        return $urlArr[0];
    }

    public function getUrlArr(){
        return explode(',', $this->getUrl());
    }

    /**
     * Set selectRules
     *
     * @param string $selectRules
     *
     * @return Site
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
     * Set titleRules
     *
     * @param string $titleRules
     *
     * @return Site
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
     * Set linkRules
     *
     * @param string $linkRules
     *
     * @return Site
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
     * @return Site
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
     * Set SourceRules
     *
     * @param string $sourceRules
     *
     * @return Site
     */
    public function setSourceRules($sourceRules)
    {
        $this->sourceRules = $sourceRules;

        return $this;
    }

    /**
     * Get getSourceRules
     *
     * @return string
     */
    public function getSourceRules()
    {
        return $this->sourceRules;
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
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return Site
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return Site
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

    public function getLinkPrefix(){
        return isset($this->getPrefixObject()->link) ? $this->getPrefixObject()->link : "";
    }

    /**
     * Set listPageOtherRules
     *
     * @param string $listPageOtherRules
     *
     * @return Site
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
     * @return Site
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
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Site
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}

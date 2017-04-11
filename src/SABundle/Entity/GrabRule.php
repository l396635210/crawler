<?php

namespace SABundle\Entity;

use AppBundle\Entity\CommonCode;
use DatumBundle\Entity\Channel;
use Doctrine\ORM\Mapping as ORM;

/**
 * GrabRule
 *
 * @ORM\Table(name="grab_rule")
 * @ORM\Entity(repositoryClass="SABundle\Repository\GrabRuleRepository")
 */
class GrabRule
{
    /**
     * @ORM\OneToMany(targetEntity="GrabLog", mappedBy="grabRule")
     */
    private $grabLogs;

    public function getGrabLogs(){
        return $this->grabLogs;
    }

    /**
     * @ORM\OneToMany(targetEntity="GrabData", mappedBy="grabRule")
     */
    private $grabDatas;

    public function getGrabDatas(){
        return $this->grabDatas;
    }

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
     * @ORM\Column(name="urls", type="text")
     */
    private $urls;

    /**
     * @var string
     *
     * @ORM\Column(name="prefix", type="text", nullable=true)
     */
    private $prefix;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text")
     */
    private $data;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="entity", type="string")
     */
    private $entity;

    /**
     * @var int
     *
     * @ORM\Column(name="entity_id", type="integer")
     */
    private $entityId;

    /**
     * @var string
     *
     * @ORM\Column(name="cookies", type="string", nullable=true)
     */
    private $cookies;

    private static $requestMapping = [
        "company" => CommonCode::AppBundle_Company,
        "info"    => CommonCode::AppBundle_Site,
        "zhanhui" => CommonCode::ZhanhuiBundle_Channel,
        "qa"      => CommonCode::QABundle_QAList,
        "datum"   => Channel::LOGIC_NAME,
    ];
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
     * Set data
     *
     * @param string $data
     *
     * @return GrabRule
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
     * Set status
     *
     * @param boolean $status
     *
     * @return GrabRule
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

    public function setGrabOptions($grabOptions){

    }
    public function getGrabOptions(){
        return  ;
    }

    public function getGrabRule(){
        return;
    }

    /**
     * Set entity
     *
     * @param string $entity
     *
     * @return GrabRule
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity
     *
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set entityId
     *
     * @param integer $entityId
     *
     * @return GrabRule
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId
     *
     * @return integer
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Set urls
     *
     * @param string $urls
     *
     * @return GrabRule
     */
    public function setUrls($urls)
    {
        $this->urls = $urls;

        return $this;
    }

    /**
     * Get urls
     *
     * @return string
     */
    public function getUrls()
    {
        return $this->urls;
    }

    public function getUrlsArr(){
        return explode(",",$this->urls);
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return GrabRule
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

    public static function getRequestMapping($entity){
        if(isset(self::$requestMapping[$entity])){
            return self::$requestMapping[$entity];
        }
        return null;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->grabLogs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->grabDatas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cookies
     *
     * @param string $cookies
     *
     * @return GrabRule
     */
    public function setCookies($cookies)
    {
        $this->cookies = $cookies;

        return $this;
    }

    /**
     * Get cookies
     *
     * @return string
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * Add grabLog
     *
     * @param \SABundle\Entity\GrabLog $grabLog
     *
     * @return GrabRule
     */
    public function addGrabLog(\SABundle\Entity\GrabLog $grabLog)
    {
        $this->grabLogs[] = $grabLog;

        return $this;
    }

    /**
     * Remove grabLog
     *
     * @param \SABundle\Entity\GrabLog $grabLog
     */
    public function removeGrabLog(\SABundle\Entity\GrabLog $grabLog)
    {
        $this->grabLogs->removeElement($grabLog);
    }

    /**
     * Add grabData
     *
     * @param \SABundle\Entity\GrabData $grabData
     *
     * @return GrabRule
     */
    public function addGrabData(\SABundle\Entity\GrabData $grabData)
    {
        $this->grabDatas[] = $grabData;

        return $this;
    }

    /**
     * Remove grabData
     *
     * @param \SABundle\Entity\GrabData $grabData
     */
    public function removeGrabData(\SABundle\Entity\GrabData $grabData)
    {
        $this->grabDatas->removeElement($grabData);
    }

}

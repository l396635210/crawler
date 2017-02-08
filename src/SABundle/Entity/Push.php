<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/1/22
 * Time: 12:24
 */

namespace SABundle\Entity;


use Symfony\Component\HttpKernel\Kernel;
use ZhanhuiBundle\Entity\Channel;

class Push
{
    const API_TENDER = "tender";
    const API_POST   = "post";
    const API_ZHANHUI   = "zhanhui";

    const SALT_TENDER = "Oil.Tender";
    const SALT_POST   = "Oil.Art";
    const SALT_ZHANHUI   = "Oil.Art";

    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    static private $apis = [
        "tender" => [
            "prod" => "http://chain.oilsns.com/api/tender_item",
            "dev"  => "http://yp.pecans.cn/Home/api/tender_item",
        ],
        "post" => [
            "prod" => "http://oilsns.com/api.php",
            "dev"  => "http://wp.pecans.cn/api.php",
        ],
        "zhanhui" => [
            "prod" => "http://oilsns.com/api.php",
            "dev"  => "http://wp.pecans.cn/api.php",
        ],
    ];

    public static function api($env, $type){

        if(!isset(self::$apis[$type][$env])){
            throw new \Exception("环境或类型填写错误");
        }
        return self::$apis[$type][$env];
    }

    public static function filterTenderCloseDate($closeDate){
        if(stripos($closeDate, "Closing Date: ")===0){
            $closeDate = substr($closeDate, strlen("Closing Date: "));
        }
        return $closeDate;
    }

    public function getPushDataElement($key){
        return isset($this->data[$key]) ? preg_replace("/\s\s+/", " ", $this->data[$key]) : "";
    }

    public static function getTenderData(GrabData $grabData){
        $self = new self($grabData->getGrabData());
        $data  = array(
            'id' => $grabData->getId(),
            'company_id'    => $grabData->getGrabRule()->getEntityId(),
            'tender_no'     => $self->getPushDataElement("tender-code"),
            'title'         => $self->getPushDataElement("title"),
            'url'           => $self->getPushDataElement("page-link"),
            'update_date'   => $grabData->getCreateDate()->format('Y-m-d'),
            'end_date'      => self::filterTenderCloseDate($self->getPushDataElement("datetime2")),
            'description'   => '',   // 简介，目前不用抓取，预留以后使用
            'attachment'    => '',    // 附件，目前不用抓取，预留以后使用
        );
        ksort($data);
        return $data;
    }

    /**
     * @return array
     */
    public static function getPostData(GrabData $grabData)
    {
        $self = new self($grabData->getGrabData());
        $data  = array(
            'id'            => $grabData->getId(),
            'con'           => $self->getPushDataElement("content"),
            'source'        => $self->getPushDataElement("info_source"),
            'title'         => $self->getPushDataElement("title"),
            'url'           => $self->getPushDataElement("page-link"),
        );
        ksort($data);
        return $data;
    }

    /**
     * @param GrabData $grabData
     */
    public static function getZhanhuiData(GrabData $grabData, $channels){
        $self = new self($grabData->getGrabData());
        $country = $channels[$grabData->getGrabRule()->getEntityId()]->getArea()->getPid();
        $myfCountry = Channel::getMyfCountry($country);
        $area = $grabData->getGrabRule()->getEntityId();
        $myfArea = Channel::getMyfArea($area);
        $data  = array(
            'id'            => $grabData->getId(),
            'title'         => $self->getPushDataElement("title1"),
            'con1'          => $self->getPushDataElement("content"),
            'con2'          => $self->getPushDataElement("content1"),
            'con3'          => preg_replace("/\s\s+/", "@oilsns",$self->getPushDataElement("content2")),
            'time'          => $self->getPushDataElement("datetime2"),
            'address'       => $self->getPushDataElement("address"),
            'square'        => $self->getPushDataElement("text_spare"),
            'img'           => $self->getPushDataElement("img"),
            'sponsor'       => $self->getPushDataElement("text_spare_1"),
            'country'       => $myfCountry,
            'area'          => $myfArea,
            'url'           => $self->getPushDataElement("page-link"),
        );
        ksort($data);
        return $data;
    }

    public static function setToken($data, $salt){
        $singstr = implode('-',$data);
        $token = md5($singstr.$salt);
        return $token;
    }
}
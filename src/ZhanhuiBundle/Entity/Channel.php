<?php

namespace ZhanhuiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZhanhuiBundle\Entity\Area;
/**
 * Channel
 *
 * @ORM\Table(name="zh_channel")
 * @ORM\Entity(repositoryClass="ZhanhuiBundle\Repository\ChannelRepository")
 */
class Channel
{
    private static $myfAreas = [
        1 =>    346, 2 =>    347, 3 =>    348, 4 =>    349, 5 =>    350,
        6 =>    351, 7 =>    352, 8 =>    353, 9 =>    354, 10 =>   355,
        11 =>   356, 12 =>   357, 13 =>   358, 14 =>   359, 15 =>   360,
        16 =>   361, 17 =>   362, 18 =>   363, 19 =>   364, 20 =>   365,
        21 =>   366, 22 =>   367, 23 =>   368, 24 =>   369, 25 =>   370,
        26 =>   371, 27 =>   372, 28 =>   373, 29 =>   374, 30 =>   375,
        31 =>   376, 32 =>   377, 33 =>   378, 34 =>   379, 35 =>   316,
        36 =>   317, 37 =>   318, 38 =>   319, 39 =>   320, 40 =>   321,
        41 =>   322, 42 =>   323, 43 =>   324, 44 =>   325, 45 =>   326,
        46 =>   327, 47 =>   328, 48 =>   329, 49 =>   330, 50 =>   331,
        51 =>   332, 52 =>   333, 53 =>   334, 54 =>   335, 55 =>   336,
        56 =>   337, 57 =>   338, 58 =>   339, 59 =>   340, 60 =>   341,
        61 =>   342, 62 =>   343, 63 =>   344, 64 =>   345,
    ];

    /**
     * @return int
     */
    public static function getMyfArea($area)
    {
        return isset(self::$myfAreas[$area]) ?  self::$myfAreas[$area] : -1;
    }

    private static $myfCountries = [1=>86, 2=>87];

    /**
     * @return int
     */
    public static function getMyfCountry($country){
        return isset(self::$myfCountries[$country]) ? self::$myfCountries[$country] : $country;
    }
    /**
     * Many Channels Have One Area
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="channels")
     * @ORM\JoinColumn(name="a_id", referencedColumnName="id")
     */
    private $area;

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
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     */
    private $url;

    /**
     * @var int
     *
     * @ORM\Column(name="a_id", type="integer")
     */
    private $aId;

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
     * @return Channel
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
     * @return Channel
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

    /**
     * Set aId
     *
     * @param integer $aId
     *
     * @return Channel
     */
    public function setAId($aId)
    {
        $this->aId = $aId;

        return $this;
    }

    /**
     * Get aId
     *
     * @return int
     */
    public function getAId()
    {
        return $this->aId;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Channel
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
     * @return Channel
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
     * Set area
     *
     * @param \ZhanhuiBundle\Entity\Area $area
     *
     * @return Channel
     */
    public function setArea(\ZhanhuiBundle\Entity\Area $area = null)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \ZhanhuiBundle\Entity\Area
     */
    public function getArea()
    {
        return $this->area;
    }
}

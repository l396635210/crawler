<?php

namespace WordPressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpBaidusubmitUrlstat
 *
 * @ORM\Table(name="wp_baidusubmit_urlstat", uniqueConstraints={@ORM\UniqueConstraint(name="ctime", columns={"ctime"})})
 * @ORM\Entity
 */
class WpBaidusubmitUrlstat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="ctime", type="integer", nullable=false)
     */
    private $ctime = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="urlnum", type="integer", nullable=false)
     */
    private $urlnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="urlcount", type="bigint", nullable=false)
     */
    private $urlcount = '0';



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
     * Set ctime
     *
     * @param integer $ctime
     *
     * @return WpBaidusubmitUrlstat
     */
    public function setCtime($ctime)
    {
        $this->ctime = $ctime;

        return $this;
    }

    /**
     * Get ctime
     *
     * @return integer
     */
    public function getCtime()
    {
        return $this->ctime;
    }

    /**
     * Set urlnum
     *
     * @param integer $urlnum
     *
     * @return WpBaidusubmitUrlstat
     */
    public function setUrlnum($urlnum)
    {
        $this->urlnum = $urlnum;

        return $this;
    }

    /**
     * Get urlnum
     *
     * @return integer
     */
    public function getUrlnum()
    {
        return $this->urlnum;
    }

    /**
     * Set urlcount
     *
     * @param integer $urlcount
     *
     * @return WpBaidusubmitUrlstat
     */
    public function setUrlcount($urlcount)
    {
        $this->urlcount = $urlcount;

        return $this;
    }

    /**
     * Get urlcount
     *
     * @return integer
     */
    public function getUrlcount()
    {
        return $this->urlcount;
    }
}

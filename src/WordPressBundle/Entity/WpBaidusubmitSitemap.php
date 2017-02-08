<?php

namespace WordPressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpBaidusubmitSitemap
 *
 * @ORM\Table(name="wp_baidusubmit_sitemap", indexes={@ORM\Index(name="start", columns={"start"}), @ORM\Index(name="end", columns={"end"})})
 * @ORM\Entity
 */
class WpBaidusubmitSitemap
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sid;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="create_time", type="integer", nullable=false)
     */
    private $createTime = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="start", type="integer", nullable=true)
     */
    private $start = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="end", type="integer", nullable=true)
     */
    private $end = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="item_count", type="integer", nullable=true)
     */
    private $itemCount = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="file_size", type="integer", nullable=true)
     */
    private $fileSize = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="lost_time", type="integer", nullable=true)
     */
    private $lostTime = '0';



    /**
     * Get sid
     *
     * @return integer
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return WpBaidusubmitSitemap
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
     * Set type
     *
     * @param boolean $type
     *
     * @return WpBaidusubmitSitemap
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set createTime
     *
     * @param integer $createTime
     *
     * @return WpBaidusubmitSitemap
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return integer
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set start
     *
     * @param integer $start
     *
     * @return WpBaidusubmitSitemap
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return integer
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param integer $end
     *
     * @return WpBaidusubmitSitemap
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return integer
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set itemCount
     *
     * @param integer $itemCount
     *
     * @return WpBaidusubmitSitemap
     */
    public function setItemCount($itemCount)
    {
        $this->itemCount = $itemCount;

        return $this;
    }

    /**
     * Get itemCount
     *
     * @return integer
     */
    public function getItemCount()
    {
        return $this->itemCount;
    }

    /**
     * Set fileSize
     *
     * @param integer $fileSize
     *
     * @return WpBaidusubmitSitemap
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get fileSize
     *
     * @return integer
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set lostTime
     *
     * @param integer $lostTime
     *
     * @return WpBaidusubmitSitemap
     */
    public function setLostTime($lostTime)
    {
        $this->lostTime = $lostTime;

        return $this;
    }

    /**
     * Get lostTime
     *
     * @return integer
     */
    public function getLostTime()
    {
        return $this->lostTime;
    }
}

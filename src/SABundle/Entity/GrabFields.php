<?php

namespace SABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrabFields
 *
 * @ORM\Table(name="grab_fields")
 * @ORM\Entity(repositoryClass="SABundle\Repository\GrabFieldsRepository")
 */
class GrabFields
{
    const FIELD_LINK = "page-link";

    const LINK = 1;
    const IMG = 2;
    const _LIST = 3;
    protected static $tagTypes = [ "文本", "链接", "图片", "列表"];
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
     * @var bool
     *
     * @ORM\Column(name="tag_type", type="integer")
     */
    private $tagType;

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
     * @return GrabFields
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
     * Set status
     *
     * @param boolean $status
     *
     * @return GrabFields
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
     * @return GrabFields
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
     * Set tagType
     *
     * @param integer $tagType
     *
     * @return GrabFields
     */
    public function setTagType($tagType)
    {
        $this->tagType = $tagType;

        return $this;
    }

    /**
     * Get tagType
     *
     * @return integer
     */
    public function getTagType()
    {
        if(!is_null($this->tagType)){
            return self::getTagTypes()[$this->tagType];
        }
        return $this->tagType;
    }

    //获取标签列表
    public static function getTagTypes(){
        return self::$tagTypes;
    }

    public function isLink(){
        return $this->getTagType() == self::getTagTypes()[self::LINK];
    }

    public function isImg(){
        return $this->getTagType() == self::getTagTypes()[self::IMG];
    }

    public function isList(){
        return $this->getTagType() == self::getTagTypes()[self::_LIST];
    }
}

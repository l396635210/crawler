<?php

namespace WordPressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpActivecode
 *
 * @ORM\Table(name="wp_activecode")
 * @ORM\Entity
 */
class WpActivecode
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20, nullable=true)
     */
    private $code = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="days", type="integer", nullable=true)
     */
    private $days = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="smallint", nullable=true)
     */
    private $active = '0';



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
     * Set code
     *
     * @param string $code
     *
     * @return WpActivecode
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
     * Set days
     *
     * @param integer $days
     *
     * @return WpActivecode
     */
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return integer
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return WpActivecode
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }
}

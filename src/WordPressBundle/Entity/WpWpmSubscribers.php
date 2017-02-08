<?php

namespace WordPressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpWpmSubscribers
 *
 * @ORM\Table(name="wp_wpm_subscribers", uniqueConstraints={@ORM\UniqueConstraint(name="sub_id", columns={"sub_id"}), @ORM\UniqueConstraint(name="unique_sub_email", columns={"sub_email"})})
 * @ORM\Entity
 */
class WpWpmSubscribers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sub_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $subId;

    /**
     * @var string
     *
     * @ORM\Column(name="sub_name", type="string", length=200, nullable=false)
     */
    private $subName;

    /**
     * @var string
     *
     * @ORM\Column(name="sub_email", type="string", length=200, nullable=false)
     */
    private $subEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sub_added", type="datetime", nullable=false)
     */
    private $subAdded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sub_removed", type="datetime", nullable=false)
     */
    private $subRemoved;

    /**
     * @var string
     *
     * @ORM\Column(name="test_tag", type="string", length=200, nullable=true)
     */
    private $testTag;



    /**
     * Get subId
     *
     * @return integer
     */
    public function getSubId()
    {
        return $this->subId;
    }

    /**
     * Set subName
     *
     * @param string $subName
     *
     * @return WpWpmSubscribers
     */
    public function setSubName($subName)
    {
        $this->subName = $subName;

        return $this;
    }

    /**
     * Get subName
     *
     * @return string
     */
    public function getSubName()
    {
        return $this->subName;
    }

    /**
     * Set subEmail
     *
     * @param string $subEmail
     *
     * @return WpWpmSubscribers
     */
    public function setSubEmail($subEmail)
    {
        $this->subEmail = $subEmail;

        return $this;
    }

    /**
     * Get subEmail
     *
     * @return string
     */
    public function getSubEmail()
    {
        return $this->subEmail;
    }

    /**
     * Set subAdded
     *
     * @param \DateTime $subAdded
     *
     * @return WpWpmSubscribers
     */
    public function setSubAdded($subAdded)
    {
        $this->subAdded = $subAdded;

        return $this;
    }

    /**
     * Get subAdded
     *
     * @return \DateTime
     */
    public function getSubAdded()
    {
        return $this->subAdded;
    }

    /**
     * Set subRemoved
     *
     * @param \DateTime $subRemoved
     *
     * @return WpWpmSubscribers
     */
    public function setSubRemoved($subRemoved)
    {
        $this->subRemoved = $subRemoved;

        return $this;
    }

    /**
     * Get subRemoved
     *
     * @return \DateTime
     */
    public function getSubRemoved()
    {
        return $this->subRemoved;
    }

    /**
     * Set testTag
     *
     * @param string $testTag
     *
     * @return WpWpmSubscribers
     */
    public function setTestTag($testTag)
    {
        $this->testTag = $testTag;

        return $this;
    }

    /**
     * Get testTag
     *
     * @return string
     */
    public function getTestTag()
    {
        return $this->testTag;
    }
}

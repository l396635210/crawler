<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailLog
 *
 * @ORM\Table(name="mail_log")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MailLogRepository")
 */
class MailLog
{
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
     * @ORM\Column(name="sent_to", type="string", length=255)
     */
    private $sentTo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sent_date", type="date")
     */
    private $sentDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sent_time", type="time")
     */
    private $sentTime;

    /**
     * @var int
     *
     * @ORM\Column(name="sent_type", type="smallint")
     */
    private $sentType;

    /**
     * @var string
     *
     * @ORM\Column(name="sent_title", type="string", length=255)
     */
    private $sentTitle;


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
     * Set sentTo
     *
     * @param string $sentTo
     *
     * @return MailLog
     */
    public function setSentTo($sentTo)
    {
        $this->sentTo = $sentTo;

        return $this;
    }

    /**
     * Get sentTo
     *
     * @return string
     */
    public function getSentTo()
    {
        return $this->sentTo;
    }

    /**
     * Set sentDate
     *
     * @param \DateTime $sentDate
     *
     * @return MailLog
     */
    public function setSentDate($sentDate)
    {
        $this->sentDate = $sentDate;

        return $this;
    }

    /**
     * Get sentDate
     *
     * @return \DateTime
     */
    public function getSentDate()
    {
        return $this->sentDate;
    }

    /**
     * Set sentTime
     *
     * @param \DateTime $sentTime
     *
     * @return MailLog
     */
    public function setSentTime($sentTime)
    {
        $this->sentTime = $sentTime;

        return $this;
    }

    /**
     * Get sentTime
     *
     * @return \DateTime
     */
    public function getSentTime()
    {
        return $this->sentTime;
    }

    /**
     * Set sentType
     *
     * @param integer $sentType
     *
     * @return MailLog
     */
    public function setSentType($sentType)
    {
        $this->sentType = $sentType;

        return $this;
    }

    /**
     * Get sentType
     *
     * @return int
     */
    public function getSentType()
    {
        return $this->sentType;
    }

    /**
     * Set sentTitle
     *
     * @param string $sentTitle
     *
     * @return MailLog
     */
    public function setSentTitle($sentTitle)
    {
        $this->sentTitle = $sentTitle;

        return $this;
    }

    /**
     * Get sentTitle
     *
     * @return string
     */
    public function getSentTitle()
    {
        return $this->sentTitle;
    }
}

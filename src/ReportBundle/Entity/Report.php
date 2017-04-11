<?php

namespace ReportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Report
 *
 * @ORM\Table(name="report_report")
 * @ORM\Entity(repositoryClass="ReportBundle\Repository\ReportRepository")
 */
class Report
{
    const NUM_ITEMS = 20;

    /**
     * @var Channel
     * @ORM\ManyToOne(targetEntity="Channel", inversedBy="reports")
     */
    private $channel;

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="get_at", type="datetime")
     */
    private $getAt;


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
     * Set title
     *
     * @param string $title
     *
     * @return Report
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Report
     */
    public function setContent($content)
    {
        if(strstr($this->channel->getName(),"rigzone-news")){
            $content = trim(substr($content,6));
        }
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Report
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set getAt
     *
     * @param \DateTime $getAt
     *
     * @return Report
     */
    public function setGetAt($getAt)
    {
        $this->getAt = $getAt;

        return $this;
    }

    /**
     * Get getAt
     *
     * @return \DateTime
     */
    public function getGetAt()
    {
        return $this->getAt;
    }

    /**
     * Set channel
     *
     * @param \ReportBundle\Entity\Channel $channel
     *
     * @return Report
     */
    public function setChannel(\ReportBundle\Entity\Channel $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \ReportBundle\Entity\Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }
}

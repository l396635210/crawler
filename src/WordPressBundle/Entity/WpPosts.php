<?php

namespace WordPressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpPosts
 *
 * @ORM\Table(name="wp_posts", indexes={@ORM\Index(name="post_name", columns={"post_name"}), @ORM\Index(name="type_status_date", columns={"post_type", "post_status", "post_date", "ID"}), @ORM\Index(name="post_parent", columns={"post_parent"}), @ORM\Index(name="post_author", columns={"post_author"})})
 * @ORM\Entity
 */
class WpPosts
{
    const CATE_MEDIA_RETWEET = 297; //栏目

    const ROLE_RETWEET_HELPER = 291; //用户

    const POST_STATUS_PUBLISH = 'publish'; //发布状态

    const COMMENT_STATUS_OPEN = 'open'; //发布状态

    const PING_STATUS_OPEN    = 'open'; //发布状态
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_author", type="bigint", nullable=false)
     */
    private $postAuthor = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_date", type="datetime", nullable=false)
     */
    private $postDate = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_date_gmt", type="datetime", nullable=false)
     */
    private $postDateGmt = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="post_content", type="text", nullable=false)
     */
    private $postContent;

    /**
     * @var string
     *
     * @ORM\Column(name="post_title", type="text", length=65535, nullable=false)
     */
    private $postTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="post_excerpt", type="text", length=65535, nullable=false)
     */
    private $postExcerpt = '';

    /**
     * @var string
     *
     * @ORM\Column(name="post_status", type="string", length=20, nullable=false)
     */
    private $postStatus = 'publish';

    /**
     * @var string
     *
     * @ORM\Column(name="comment_status", type="string", length=20, nullable=false)
     */
    private $commentStatus = 'open';

    /**
     * @var string
     *
     * @ORM\Column(name="ping_status", type="string", length=20, nullable=false)
     */
    private $pingStatus = 'open';

    /**
     * @var string
     *
     * @ORM\Column(name="post_password", type="string", length=20, nullable=false)
     */
    private $postPassword = '';

    /**
     * @var string
     *
     * @ORM\Column(name="post_name", type="string", length=200, nullable=false)
     */
    private $postName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="to_ping", type="text", length=65535, nullable=false)
     */
    private $toPing = '';

    /**
     * @var string
     *
     * @ORM\Column(name="pinged", type="text", length=65535, nullable=false)
     */
    private $pinged = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_modified", type="datetime", nullable=false)
     */
    private $postModified = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_modified_gmt", type="datetime", nullable=false)
     */
    private $postModifiedGmt = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="post_content_filtered", type="text", nullable=false)
     */
    private $postContentFiltered = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="post_parent", type="bigint", nullable=false)
     */
    private $postParent = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="guid", type="string", length=255, nullable=false)
     */
    private $guid = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="menu_order", type="integer", nullable=false)
     */
    private $menuOrder = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="post_type", type="string", length=20, nullable=false)
     */
    private $postType = 'post';

    /**
     * @var string
     *
     * @ORM\Column(name="post_mime_type", type="string", length=100, nullable=false)
     */
    private $postMimeType = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="comment_count", type="bigint", nullable=false)
     */
    private $commentCount = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="post_recommend", type="smallint", nullable=true)
     */
    private $postRecommend = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="post_needcharge", type="smallint", nullable=true)
     */
    private $postNeedcharge = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="post_d", type="smallint", nullable=true)
     */
    private $postD;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_b", type="smallint", nullable=true)
     */
    private $postB;

    /**
     * @var string
     *
     * @ORM\Column(name="post_qs", type="string", length=500, nullable=true)
     */
    private $postQs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_qn", type="datetime", nullable=true)
     */
    private $postQn;

    /**
     * @var string
     *
     * @ORM\Column(name="post_z", type="string", length=500, nullable=true)
     */
    private $postZ;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_subscibe", type="smallint", nullable=true)
     */
    private $postSubscibe;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_istop", type="smallint", nullable=false)
     */
    private $postIstop = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="post_companies", type="string", length=500, nullable=true)
     */
    private $postCompanies;



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
     * Set postAuthor
     *
     * @param integer $postAuthor
     *
     * @return WpPosts
     */
    public function setPostAuthor($postAuthor)
    {
        $this->postAuthor = $postAuthor;

        return $this;
    }

    /**
     * Get postAuthor
     *
     * @return integer
     */
    public function getPostAuthor()
    {
        return $this->postAuthor;
    }

    /**
     * Set postDate
     *
     * @param \DateTime $postDate
     *
     * @return WpPosts
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get postDate
     *
     * @return \DateTime
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * Set postDateGmt
     *
     * @param \DateTime $postDateGmt
     *
     * @return WpPosts
     */
    public function setPostDateGmt($postDateGmt)
    {
        $this->postDateGmt = $postDateGmt;

        return $this;
    }

    /**
     * Get postDateGmt
     *
     * @return \DateTime
     */
    public function getPostDateGmt()
    {
        return $this->postDateGmt;
    }

    /**
     * Set postContent
     *
     * @param string $postContent
     *
     * @return WpPosts
     */
    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;

        return $this;
    }

    /**
     * Get postContent
     *
     * @return string
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * Set postTitle
     *
     * @param string $postTitle
     *
     * @return WpPosts
     */
    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;

        return $this;
    }

    /**
     * Get postTitle
     *
     * @return string
     */
    public function getPostTitle()
    {
        return $this->postTitle;
    }

    /**
     * Set postExcerpt
     *
     * @param string $postExcerpt
     *
     * @return WpPosts
     */
    public function setPostExcerpt($postExcerpt)
    {
        $this->postExcerpt = $postExcerpt;

        return $this;
    }

    /**
     * Get postExcerpt
     *
     * @return string
     */
    public function getPostExcerpt()
    {
        return $this->postExcerpt;
    }

    /**
     * Set postStatus
     *
     * @param string $postStatus
     *
     * @return WpPosts
     */
    public function setPostStatus($postStatus)
    {
        $this->postStatus = $postStatus;

        return $this;
    }

    /**
     * Get postStatus
     *
     * @return string
     */
    public function getPostStatus()
    {
        return $this->postStatus;
    }

    /**
     * Set commentStatus
     *
     * @param string $commentStatus
     *
     * @return WpPosts
     */
    public function setCommentStatus($commentStatus)
    {
        $this->commentStatus = $commentStatus;

        return $this;
    }

    /**
     * Get commentStatus
     *
     * @return string
     */
    public function getCommentStatus()
    {
        return $this->commentStatus;
    }

    /**
     * Set pingStatus
     *
     * @param string $pingStatus
     *
     * @return WpPosts
     */
    public function setPingStatus($pingStatus)
    {
        $this->pingStatus = $pingStatus;

        return $this;
    }

    /**
     * Get pingStatus
     *
     * @return string
     */
    public function getPingStatus()
    {
        return $this->pingStatus;
    }

    /**
     * Set postPassword
     *
     * @param string $postPassword
     *
     * @return WpPosts
     */
    public function setPostPassword($postPassword)
    {
        $this->postPassword = $postPassword;

        return $this;
    }

    /**
     * Get postPassword
     *
     * @return string
     */
    public function getPostPassword()
    {
        return $this->postPassword;
    }

    /**
     * Set postName
     *
     * @param string $postName
     *
     * @return WpPosts
     */
    public function setPostName($postName)
    {
        $this->postName = $postName;

        return $this;
    }

    /**
     * Get postName
     *
     * @return string
     */
    public function getPostName()
    {
        return $this->postName;
    }

    /**
     * Set toPing
     *
     * @param string $toPing
     *
     * @return WpPosts
     */
    public function setToPing($toPing)
    {
        $this->toPing = $toPing;

        return $this;
    }

    /**
     * Get toPing
     *
     * @return string
     */
    public function getToPing()
    {
        return $this->toPing;
    }

    /**
     * Set pinged
     *
     * @param string $pinged
     *
     * @return WpPosts
     */
    public function setPinged($pinged)
    {
        $this->pinged = $pinged;

        return $this;
    }

    /**
     * Get pinged
     *
     * @return string
     */
    public function getPinged()
    {
        return $this->pinged;
    }

    /**
     * Set postModified
     *
     * @param \DateTime $postModified
     *
     * @return WpPosts
     */
    public function setPostModified($postModified)
    {
        $this->postModified = $postModified;

        return $this;
    }

    /**
     * Get postModified
     *
     * @return \DateTime
     */
    public function getPostModified()
    {
        return $this->postModified;
    }

    /**
     * Set postModifiedGmt
     *
     * @param \DateTime $postModifiedGmt
     *
     * @return WpPosts
     */
    public function setPostModifiedGmt($postModifiedGmt)
    {
        $this->postModifiedGmt = $postModifiedGmt;

        return $this;
    }

    /**
     * Get postModifiedGmt
     *
     * @return \DateTime
     */
    public function getPostModifiedGmt()
    {
        return $this->postModifiedGmt;
    }

    /**
     * Set postContentFiltered
     *
     * @param string $postContentFiltered
     *
     * @return WpPosts
     */
    public function setPostContentFiltered($postContentFiltered)
    {
        $this->postContentFiltered = $postContentFiltered;

        return $this;
    }

    /**
     * Get postContentFiltered
     *
     * @return string
     */
    public function getPostContentFiltered()
    {
        return $this->postContentFiltered;
    }

    /**
     * Set postParent
     *
     * @param integer $postParent
     *
     * @return WpPosts
     */
    public function setPostParent($postParent)
    {
        $this->postParent = $postParent;

        return $this;
    }

    /**
     * Get postParent
     *
     * @return integer
     */
    public function getPostParent()
    {
        return $this->postParent;
    }

    /**
     * Set guid
     *
     * @param string $guid
     *
     * @return WpPosts
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;

        return $this;
    }

    /**
     * Get guid
     *
     * @return string
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * Set menuOrder
     *
     * @param integer $menuOrder
     *
     * @return WpPosts
     */
    public function setMenuOrder($menuOrder)
    {
        $this->menuOrder = $menuOrder;

        return $this;
    }

    /**
     * Get menuOrder
     *
     * @return integer
     */
    public function getMenuOrder()
    {
        return $this->menuOrder;
    }

    /**
     * Set postType
     *
     * @param string $postType
     *
     * @return WpPosts
     */
    public function setPostType($postType)
    {
        $this->postType = $postType;

        return $this;
    }

    /**
     * Get postType
     *
     * @return string
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * Set postMimeType
     *
     * @param string $postMimeType
     *
     * @return WpPosts
     */
    public function setPostMimeType($postMimeType)
    {
        $this->postMimeType = $postMimeType;

        return $this;
    }

    /**
     * Get postMimeType
     *
     * @return string
     */
    public function getPostMimeType()
    {
        return $this->postMimeType;
    }

    /**
     * Set commentCount
     *
     * @param integer $commentCount
     *
     * @return WpPosts
     */
    public function setCommentCount($commentCount)
    {
        $this->commentCount = $commentCount;

        return $this;
    }

    /**
     * Get commentCount
     *
     * @return integer
     */
    public function getCommentCount()
    {
        return $this->commentCount;
    }

    /**
     * Set postRecommend
     *
     * @param integer $postRecommend
     *
     * @return WpPosts
     */
    public function setPostRecommend($postRecommend)
    {
        $this->postRecommend = $postRecommend;

        return $this;
    }

    /**
     * Get postRecommend
     *
     * @return integer
     */
    public function getPostRecommend()
    {
        return $this->postRecommend;
    }

    /**
     * Set postNeedcharge
     *
     * @param integer $postNeedcharge
     *
     * @return WpPosts
     */
    public function setPostNeedcharge($postNeedcharge)
    {
        $this->postNeedcharge = $postNeedcharge;

        return $this;
    }

    /**
     * Get postNeedcharge
     *
     * @return integer
     */
    public function getPostNeedcharge()
    {
        return $this->postNeedcharge;
    }

    /**
     * Set postD
     *
     * @param integer $postD
     *
     * @return WpPosts
     */
    public function setPostD($postD)
    {
        $this->postD = $postD;

        return $this;
    }

    /**
     * Get postD
     *
     * @return integer
     */
    public function getPostD()
    {
        return $this->postD;
    }

    /**
     * Set postB
     *
     * @param integer $postB
     *
     * @return WpPosts
     */
    public function setPostB($postB)
    {
        $this->postB = $postB;

        return $this;
    }

    /**
     * Get postB
     *
     * @return integer
     */
    public function getPostB()
    {
        return $this->postB;
    }

    /**
     * Set postQs
     *
     * @param string $postQs
     *
     * @return WpPosts
     */
    public function setPostQs($postQs)
    {
        $this->postQs = $postQs;

        return $this;
    }

    /**
     * Get postQs
     *
     * @return string
     */
    public function getPostQs()
    {
        return $this->postQs;
    }

    /**
     * Set postQn
     *
     * @param \DateTime $postQn
     *
     * @return WpPosts
     */
    public function setPostQn($postQn)
    {
        $this->postQn = $postQn;

        return $this;
    }

    /**
     * Get postQn
     *
     * @return \DateTime
     */
    public function getPostQn()
    {
        return $this->postQn;
    }

    /**
     * Set postZ
     *
     * @param string $postZ
     *
     * @return WpPosts
     */
    public function setPostZ($postZ)
    {
        $this->postZ = $postZ;

        return $this;
    }

    /**
     * Get postZ
     *
     * @return string
     */
    public function getPostZ()
    {
        return $this->postZ;
    }

    /**
     * Set postSubscibe
     *
     * @param integer $postSubscibe
     *
     * @return WpPosts
     */
    public function setPostSubscibe($postSubscibe)
    {
        $this->postSubscibe = $postSubscibe;

        return $this;
    }

    /**
     * Get postSubscibe
     *
     * @return integer
     */
    public function getPostSubscibe()
    {
        return $this->postSubscibe;
    }

    /**
     * Set postIstop
     *
     * @param integer $postIstop
     *
     * @return WpPosts
     */
    public function setPostIstop($postIstop)
    {
        $this->postIstop = $postIstop;

        return $this;
    }

    /**
     * Get postIstop
     *
     * @return integer
     */
    public function getPostIstop()
    {
        return $this->postIstop;
    }

    /**
     * Set postCompanies
     *
     * @param string $postCompanies
     *
     * @return WpPosts
     */
    public function setPostCompanies($postCompanies)
    {
        $this->postCompanies = $postCompanies;

        return $this;
    }

    /**
     * Get postCompanies
     *
     * @return string
     */
    public function getPostCompanies()
    {
        return $this->postCompanies;
    }
}

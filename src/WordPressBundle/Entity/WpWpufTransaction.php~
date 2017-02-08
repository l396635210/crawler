<?php

namespace WordPressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpWpufTransaction
 *
 * @ORM\Table(name="wp_wpuf_transaction")
 * @ORM\Entity
 */
class WpWpufTransaction
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
     * @ORM\Column(name="user_id", type="bigint", nullable=true)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status = 'pending_payment';

    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="string", length=255, nullable=true)
     */
    private $cost = '';

    /**
     * @var string
     *
     * @ORM\Column(name="post_id", type="string", length=20, nullable=true)
     */
    private $postId;

    /**
     * @var integer
     *
     * @ORM\Column(name="pack_id", type="bigint", nullable=true)
     */
    private $packId;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_first_name", type="text", nullable=true)
     */
    private $payerFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_last_name", type="text", nullable=true)
     */
    private $payerLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_email", type="text", nullable=true)
     */
    private $payerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_type", type="text", nullable=true)
     */
    private $paymentType;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_address", type="text", nullable=true)
     */
    private $payerAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_id", type="text", nullable=true)
     */
    private $transactionId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;



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
     * Set userId
     *
     * @param integer $userId
     *
     * @return WpWpufTransaction
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return WpWpufTransaction
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set cost
     *
     * @param string $cost
     *
     * @return WpWpufTransaction
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set postId
     *
     * @param string $postId
     *
     * @return WpWpufTransaction
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get postId
     *
     * @return string
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set packId
     *
     * @param integer $packId
     *
     * @return WpWpufTransaction
     */
    public function setPackId($packId)
    {
        $this->packId = $packId;

        return $this;
    }

    /**
     * Get packId
     *
     * @return integer
     */
    public function getPackId()
    {
        return $this->packId;
    }

    /**
     * Set payerFirstName
     *
     * @param string $payerFirstName
     *
     * @return WpWpufTransaction
     */
    public function setPayerFirstName($payerFirstName)
    {
        $this->payerFirstName = $payerFirstName;

        return $this;
    }

    /**
     * Get payerFirstName
     *
     * @return string
     */
    public function getPayerFirstName()
    {
        return $this->payerFirstName;
    }

    /**
     * Set payerLastName
     *
     * @param string $payerLastName
     *
     * @return WpWpufTransaction
     */
    public function setPayerLastName($payerLastName)
    {
        $this->payerLastName = $payerLastName;

        return $this;
    }

    /**
     * Get payerLastName
     *
     * @return string
     */
    public function getPayerLastName()
    {
        return $this->payerLastName;
    }

    /**
     * Set payerEmail
     *
     * @param string $payerEmail
     *
     * @return WpWpufTransaction
     */
    public function setPayerEmail($payerEmail)
    {
        $this->payerEmail = $payerEmail;

        return $this;
    }

    /**
     * Get payerEmail
     *
     * @return string
     */
    public function getPayerEmail()
    {
        return $this->payerEmail;
    }

    /**
     * Set paymentType
     *
     * @param string $paymentType
     *
     * @return WpWpufTransaction
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType
     *
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set payerAddress
     *
     * @param string $payerAddress
     *
     * @return WpWpufTransaction
     */
    public function setPayerAddress($payerAddress)
    {
        $this->payerAddress = $payerAddress;

        return $this;
    }

    /**
     * Get payerAddress
     *
     * @return string
     */
    public function getPayerAddress()
    {
        return $this->payerAddress;
    }

    /**
     * Set transactionId
     *
     * @param string $transactionId
     *
     * @return WpWpufTransaction
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * Get transactionId
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return WpWpufTransaction
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}

<?php

namespace CompaniesBundle\Entity;

/**
 * QuotationItem
 */
class QuotationItem
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $qid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $qty;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $discount;

    /**
     * @var string
     */
    private $amount;


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
     * Set qid
     *
     * @param integer $qid
     *
     * @return QuotationItem
     */
    public function setQid($qid)
    {
        $this->qid = $qid;

        return $this;
    }

    /**
     * Get qid
     *
     * @return integer
     */
    public function getQid()
    {
        return $this->qid;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return QuotationItem
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
     * Set qty
     *
     * @param integer $qty
     *
     * @return QuotationItem
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty
     *
     * @return integer
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return QuotationItem
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set discount
     *
     * @param string $discount
     *
     * @return QuotationItem
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return string
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return QuotationItem
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }
}


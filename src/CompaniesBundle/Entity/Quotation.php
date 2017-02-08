<?php

namespace CompaniesBundle\Entity;

/**
 * Quotation
 */
class Quotation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var integer
     */
    private $uid;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $no;

    /**
     * @var string
     */
    private $noLabel;

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $dateLabel;

    /**
     * @var string
     */
    private $duedate;

    /**
     * @var string
     */
    private $duedateLabel;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $companyAddress;

    /**
     * @var string
     */
    private $companyRegion;

    /**
     * @var string
     */
    private $companyCountry;

    /**
     * @var string
     */
    private $toCompanyName;

    /**
     * @var string
     */
    private $toCompanyAddress;

    /**
     * @var string
     */
    private $toCompanyRegion;

    /**
     * @var string
     */
    private $toCompanyCountry = '';

    /**
     * @var string
     */
    private $total;

    /**
     * @var string
     */
    private $totalLabel;

    /**
     * @var string
     */
    private $adjust;

    /**
     * @var string
     */
    private $adjustLabel;

    /**
     * @var string
     */
    private $priceUnit;

    /**
     * @var string
     */
    private $itemTitleLabel;

    /**
     * @var string
     */
    private $itemQtyLabel;

    /**
     * @var string
     */
    private $itemPriceLabel;

    /**
     * @var string
     */
    private $itemDiscountLabel;

    /**
     * @var string
     */
    private $itemAmountLabel;

    /**
     * @var string
     */
    private $note;

    /**
     * @var string
     */
    private $noteLabel;

    /**
     * @var string
     */
    private $termsConditionsDesc;

    /**
     * @var string
     */
    private $termsConditionsDescLabel;

    /**
     * @var \DateTime
     */
    private $createtime;


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
     * Set uuid
     *
     * @param string $uuid
     *
     * @return Quotation
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set uid
     *
     * @param integer $uid
     *
     * @return Quotation
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return integer
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Quotation
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
     * Set no
     *
     * @param string $no
     *
     * @return Quotation
     */
    public function setNo($no)
    {
        $this->no = $no;

        return $this;
    }

    /**
     * Get no
     *
     * @return string
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * Set noLabel
     *
     * @param string $noLabel
     *
     * @return Quotation
     */
    public function setNoLabel($noLabel)
    {
        $this->noLabel = $noLabel;

        return $this;
    }

    /**
     * Get noLabel
     *
     * @return string
     */
    public function getNoLabel()
    {
        return $this->noLabel;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Quotation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateLabel
     *
     * @param string $dateLabel
     *
     * @return Quotation
     */
    public function setDateLabel($dateLabel)
    {
        $this->dateLabel = $dateLabel;

        return $this;
    }

    /**
     * Get dateLabel
     *
     * @return string
     */
    public function getDateLabel()
    {
        return $this->dateLabel;
    }

    /**
     * Set duedate
     *
     * @param string $duedate
     *
     * @return Quotation
     */
    public function setDuedate($duedate)
    {
        $this->duedate = $duedate;

        return $this;
    }

    /**
     * Get duedate
     *
     * @return string
     */
    public function getDuedate()
    {
        return $this->duedate;
    }

    /**
     * Set duedateLabel
     *
     * @param string $duedateLabel
     *
     * @return Quotation
     */
    public function setDuedateLabel($duedateLabel)
    {
        $this->duedateLabel = $duedateLabel;

        return $this;
    }

    /**
     * Get duedateLabel
     *
     * @return string
     */
    public function getDuedateLabel()
    {
        return $this->duedateLabel;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Quotation
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set companyAddress
     *
     * @param string $companyAddress
     *
     * @return Quotation
     */
    public function setCompanyAddress($companyAddress)
    {
        $this->companyAddress = $companyAddress;

        return $this;
    }

    /**
     * Get companyAddress
     *
     * @return string
     */
    public function getCompanyAddress()
    {
        return $this->companyAddress;
    }

    /**
     * Set companyRegion
     *
     * @param string $companyRegion
     *
     * @return Quotation
     */
    public function setCompanyRegion($companyRegion)
    {
        $this->companyRegion = $companyRegion;

        return $this;
    }

    /**
     * Get companyRegion
     *
     * @return string
     */
    public function getCompanyRegion()
    {
        return $this->companyRegion;
    }

    /**
     * Set companyCountry
     *
     * @param string $companyCountry
     *
     * @return Quotation
     */
    public function setCompanyCountry($companyCountry)
    {
        $this->companyCountry = $companyCountry;

        return $this;
    }

    /**
     * Get companyCountry
     *
     * @return string
     */
    public function getCompanyCountry()
    {
        return $this->companyCountry;
    }

    /**
     * Set toCompanyName
     *
     * @param string $toCompanyName
     *
     * @return Quotation
     */
    public function setToCompanyName($toCompanyName)
    {
        $this->toCompanyName = $toCompanyName;

        return $this;
    }

    /**
     * Get toCompanyName
     *
     * @return string
     */
    public function getToCompanyName()
    {
        return $this->toCompanyName;
    }

    /**
     * Set toCompanyAddress
     *
     * @param string $toCompanyAddress
     *
     * @return Quotation
     */
    public function setToCompanyAddress($toCompanyAddress)
    {
        $this->toCompanyAddress = $toCompanyAddress;

        return $this;
    }

    /**
     * Get toCompanyAddress
     *
     * @return string
     */
    public function getToCompanyAddress()
    {
        return $this->toCompanyAddress;
    }

    /**
     * Set toCompanyRegion
     *
     * @param string $toCompanyRegion
     *
     * @return Quotation
     */
    public function setToCompanyRegion($toCompanyRegion)
    {
        $this->toCompanyRegion = $toCompanyRegion;

        return $this;
    }

    /**
     * Get toCompanyRegion
     *
     * @return string
     */
    public function getToCompanyRegion()
    {
        return $this->toCompanyRegion;
    }

    /**
     * Set toCompanyCountry
     *
     * @param string $toCompanyCountry
     *
     * @return Quotation
     */
    public function setToCompanyCountry($toCompanyCountry)
    {
        $this->toCompanyCountry = $toCompanyCountry;

        return $this;
    }

    /**
     * Get toCompanyCountry
     *
     * @return string
     */
    public function getToCompanyCountry()
    {
        return $this->toCompanyCountry;
    }

    /**
     * Set total
     *
     * @param string $total
     *
     * @return Quotation
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set totalLabel
     *
     * @param string $totalLabel
     *
     * @return Quotation
     */
    public function setTotalLabel($totalLabel)
    {
        $this->totalLabel = $totalLabel;

        return $this;
    }

    /**
     * Get totalLabel
     *
     * @return string
     */
    public function getTotalLabel()
    {
        return $this->totalLabel;
    }

    /**
     * Set adjust
     *
     * @param string $adjust
     *
     * @return Quotation
     */
    public function setAdjust($adjust)
    {
        $this->adjust = $adjust;

        return $this;
    }

    /**
     * Get adjust
     *
     * @return string
     */
    public function getAdjust()
    {
        return $this->adjust;
    }

    /**
     * Set adjustLabel
     *
     * @param string $adjustLabel
     *
     * @return Quotation
     */
    public function setAdjustLabel($adjustLabel)
    {
        $this->adjustLabel = $adjustLabel;

        return $this;
    }

    /**
     * Get adjustLabel
     *
     * @return string
     */
    public function getAdjustLabel()
    {
        return $this->adjustLabel;
    }

    /**
     * Set priceUnit
     *
     * @param string $priceUnit
     *
     * @return Quotation
     */
    public function setPriceUnit($priceUnit)
    {
        $this->priceUnit = $priceUnit;

        return $this;
    }

    /**
     * Get priceUnit
     *
     * @return string
     */
    public function getPriceUnit()
    {
        return $this->priceUnit;
    }

    /**
     * Set itemTitleLabel
     *
     * @param string $itemTitleLabel
     *
     * @return Quotation
     */
    public function setItemTitleLabel($itemTitleLabel)
    {
        $this->itemTitleLabel = $itemTitleLabel;

        return $this;
    }

    /**
     * Get itemTitleLabel
     *
     * @return string
     */
    public function getItemTitleLabel()
    {
        return $this->itemTitleLabel;
    }

    /**
     * Set itemQtyLabel
     *
     * @param string $itemQtyLabel
     *
     * @return Quotation
     */
    public function setItemQtyLabel($itemQtyLabel)
    {
        $this->itemQtyLabel = $itemQtyLabel;

        return $this;
    }

    /**
     * Get itemQtyLabel
     *
     * @return string
     */
    public function getItemQtyLabel()
    {
        return $this->itemQtyLabel;
    }

    /**
     * Set itemPriceLabel
     *
     * @param string $itemPriceLabel
     *
     * @return Quotation
     */
    public function setItemPriceLabel($itemPriceLabel)
    {
        $this->itemPriceLabel = $itemPriceLabel;

        return $this;
    }

    /**
     * Get itemPriceLabel
     *
     * @return string
     */
    public function getItemPriceLabel()
    {
        return $this->itemPriceLabel;
    }

    /**
     * Set itemDiscountLabel
     *
     * @param string $itemDiscountLabel
     *
     * @return Quotation
     */
    public function setItemDiscountLabel($itemDiscountLabel)
    {
        $this->itemDiscountLabel = $itemDiscountLabel;

        return $this;
    }

    /**
     * Get itemDiscountLabel
     *
     * @return string
     */
    public function getItemDiscountLabel()
    {
        return $this->itemDiscountLabel;
    }

    /**
     * Set itemAmountLabel
     *
     * @param string $itemAmountLabel
     *
     * @return Quotation
     */
    public function setItemAmountLabel($itemAmountLabel)
    {
        $this->itemAmountLabel = $itemAmountLabel;

        return $this;
    }

    /**
     * Get itemAmountLabel
     *
     * @return string
     */
    public function getItemAmountLabel()
    {
        return $this->itemAmountLabel;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Quotation
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set noteLabel
     *
     * @param string $noteLabel
     *
     * @return Quotation
     */
    public function setNoteLabel($noteLabel)
    {
        $this->noteLabel = $noteLabel;

        return $this;
    }

    /**
     * Get noteLabel
     *
     * @return string
     */
    public function getNoteLabel()
    {
        return $this->noteLabel;
    }

    /**
     * Set termsConditionsDesc
     *
     * @param string $termsConditionsDesc
     *
     * @return Quotation
     */
    public function setTermsConditionsDesc($termsConditionsDesc)
    {
        $this->termsConditionsDesc = $termsConditionsDesc;

        return $this;
    }

    /**
     * Get termsConditionsDesc
     *
     * @return string
     */
    public function getTermsConditionsDesc()
    {
        return $this->termsConditionsDesc;
    }

    /**
     * Set termsConditionsDescLabel
     *
     * @param string $termsConditionsDescLabel
     *
     * @return Quotation
     */
    public function setTermsConditionsDescLabel($termsConditionsDescLabel)
    {
        $this->termsConditionsDescLabel = $termsConditionsDescLabel;

        return $this;
    }

    /**
     * Get termsConditionsDescLabel
     *
     * @return string
     */
    public function getTermsConditionsDescLabel()
    {
        return $this->termsConditionsDescLabel;
    }

    /**
     * Set createtime
     *
     * @param \DateTime $createtime
     *
     * @return Quotation
     */
    public function setCreatetime($createtime)
    {
        $this->createtime = $createtime;

        return $this;
    }

    /**
     * Get createtime
     *
     * @return \DateTime
     */
    public function getCreatetime()
    {
        return $this->createtime;
    }
}


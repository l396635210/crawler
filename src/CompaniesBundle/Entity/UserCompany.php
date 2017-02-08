<?php

namespace CompaniesBundle\Entity;

/**
 * UserCompany
 */
class UserCompany
{
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $companyId;

    /**
     * @var integer
     */
    private $isAdmin;

    /**
     * @var string
     */
    private $remark;


    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserCompany
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
     * Set companyId
     *
     * @param integer $companyId
     *
     * @return UserCompany
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set isAdmin
     *
     * @param integer $isAdmin
     *
     * @return UserCompany
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return integer
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set remark
     *
     * @param string $remark
     *
     * @return UserCompany
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get remark
     *
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }
}


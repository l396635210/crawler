<?php

namespace CompaniesBundle\Entity;

/**
 * RoleUser
 */
class RoleUser
{
    /**
     * @var integer
     */
    private $roleId;

    /**
     * @var string
     */
    private $userId;


    /**
     * Set roleId
     *
     * @param integer $roleId
     *
     * @return RoleUser
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set userId
     *
     * @param string $userId
     *
     * @return RoleUser
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }
}


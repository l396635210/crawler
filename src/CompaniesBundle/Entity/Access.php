<?php

namespace CompaniesBundle\Entity;

/**
 * Access
 */
class Access
{
    /**
     * @var integer
     */
    private $roleId;

    /**
     * @var integer
     */
    private $nodeId;

    /**
     * @var boolean
     */
    private $level;

    /**
     * @var string
     */
    private $module;


    /**
     * Set roleId
     *
     * @param integer $roleId
     *
     * @return Access
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
     * Set nodeId
     *
     * @param integer $nodeId
     *
     * @return Access
     */
    public function setNodeId($nodeId)
    {
        $this->nodeId = $nodeId;

        return $this;
    }

    /**
     * Get nodeId
     *
     * @return integer
     */
    public function getNodeId()
    {
        return $this->nodeId;
    }

    /**
     * Set level
     *
     * @param boolean $level
     *
     * @return Access
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return boolean
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set module
     *
     * @param string $module
     *
     * @return Access
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }
}


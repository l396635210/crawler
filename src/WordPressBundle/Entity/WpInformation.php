<?php

namespace WordPressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpInformation
 *
 * @ORM\Table(name="wp_information")
 * @ORM\Entity
 */
class WpInformation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="aid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aid;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=20, nullable=false)
     */
    private $username = '';

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=25, nullable=true)
     */
    private $telephone = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=32, nullable=false)
     */
    private $email = '';

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=100, nullable=false)
     */
    private $message = '0';



    /**
     * Get aid
     *
     * @return integer
     */
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return WpInformation
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return WpInformation
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return WpInformation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return WpInformation
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}

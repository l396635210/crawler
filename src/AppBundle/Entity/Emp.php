<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\HttpFoundation\Request;

/**
 * Emp
 *
 * @ORM\Table(name="emp")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmpRepository")
 */
class Emp
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
     * @ORM\Column(name="company", type="string", length=1000, nullable=true)
     */
    private $company;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_send_tenders", type="boolean", length=1)
     */
    private $isSendTenders;

    /**
     * @var string
     *
     * @ORM\Column(name="sites", type="string", length=1000, nullable=true)
     */
    private $sites;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_send_information", type="boolean", length=1)
     */
    private $isSendInformation;

    /**
     * @var string
     *
     * @ORM\Column(name="enterprise", type="string", length=50)
     */
    private $enterprise;

    /**
     * @var string
     *
     * @ORM\Column(name="emp_name", type="string", length=50)
     */
    private $empName;

    /**
     * @var string
     *
     * @ORM\Column(name="emp_mail", type="string", length=50)
     */
    private $empMail;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="string", length=255)
     */
    private $remarks;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", length=1)
     */
    private $status;

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
     * Set empName
     *
     * @param string $empName
     *
     * @return Emp
     */
    public function setEmpName($empName)
    {
        $this->empName = $empName;

        return $this;
    }

    /**
     * Get empName
     *
     * @return string
     */
    public function getEmpName()
    {
        return $this->empName;
    }

    /**
     * Set empMail
     *
     * @param string $empMail
     *
     * @return Emp
     */
    public function setEmpMail($empMail)
    {
        $this->empMail = $empMail;

        return $this;
    }

    /**
     * Get empMail
     *
     * @return string
     */
    public function getEmpMail()
    {
        return $this->empMail;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Emp
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Set enterprise
     *
     * @param string $enterprise
     *
     * @return Emp
     */
    public function setEnterprise($enterprise)
    {
        $this->enterprise = $enterprise;

        return $this;
    }

    /**
     * Get enterprise
     *
     * @return string
     */
    public function getEnterprise()
    {
        return $this->enterprise;
    }


    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Emp
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Emp
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set sites
     *
     * @param string $sites
     *
     * @return Emp
     */
    public function setSites($sites)
    {
        $this->sites = $sites;

        return $this;
    }

    /**
     * Get sites
     *
     * @return string
     */
    public function getSites()
    {
        return $this->sites;
    }

    /**
     * Set isSendTenders
     *
     * @param boolean $isSendTenders
     *
     * @return Emp
     */
    public function setIsSendTenders($isSendTenders)
    {
        $this->isSendTenders = $isSendTenders;

        return $this;
    }

    /**
     * Get isSendTenders
     *
     * @return boolean
     */
    public function getIsSendTenders()
    {
        return $this->isSendTenders;
    }

    /**
     * Set isSendInformation
     *
     * @param boolean $isSendInformation
     *
     * @return Emp
     */
    public function setIsSendInformation($isSendInformation)
    {
        $this->isSendInformation = $isSendInformation;

        return $this;
    }

    /**
     * Get isSendInformation
     *
     * @return boolean
     */
    public function getIsSendInformation()
    {
        return $this->isSendInformation;
    }

    public function setSitesForSend(Request $request){
        if($this->getSites()){
            $request->request->set("categories", Null);
            $request->request->set("sites", $this->getSites());
        }else{
            $request->request->set("sites", Null);
            $request->request->set("categories", " 1, 2, 3, 4");
        }
    }
}

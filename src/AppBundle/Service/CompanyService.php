<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/16
 * Time: 20:26
 */
namespace AppBundle\Service;

use AppBundle\Entity\Company;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;

class CompanyService{

    protected $company;

    protected function setCompany(){

    }

    public function getCompany(){
        return $this->company;
    }

    public function removeCompany(){
        $this->company = null;
    }

    public function addTenders(Company $company, $data, DomGrab $client){
        if(!$this->company)
            $this->company = $company;
        $tenderService = new TendersService();
        $tenderService->setTenders($company, $data, $client);

        $this->company->addTenders($tenderService->getTenders());
        return $this;
    }

    public function persistTenders(EntityManager $em){

        if($this->company && $this->company->getTenders()){
            foreach($this->company->getTenders() as $tenders){
                $em->persist($tenders);
            }
        }

    }

}
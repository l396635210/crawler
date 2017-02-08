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
use AppBundle\Entity\Tenders;

class TendersService{

    protected $tenders;

    public function getTenders(){
        return $this->tenders;
    }

    public function setTenders(Company $company, $data, DomGrab $domGrab){
        $tenders = new Tenders();
        $tenders->setCompany($company);
        $tenders->setTitle($data['title']);
        if( isset($data['uri']) && trim($data['uri']) ){
            $uri = isset($data['prefix']->link) ? $data['prefix']->link.$data['uri'] : $data['uri'];
            $tenders->setUrl($uri);
        }
        if( isset($data['pdf']) && trim($data['pdf']) ){
            $pdf = isset($data['prefix']->pdf) ? $data['prefix']->pdf.$data['pdf'] : $data['pdf'];
            $tenders->setPdf($pdf);
        }
        if( isset($data['publishDate']) && trim($data['publishDate']) ){
            $tenders->setPublishDate($data['publishDate']);
        }
        if( isset($data['endDate']) && trim($data['endDate']) ){
            $tenders->setEndDate($data['endDate']);
        }
        if( isset($data['code']) && trim($data['code']) ){
            $tenders->setCode($data['code']);
        }
        if( isset($data['enterprise']) && trim($data['enterprise']) ){
            $tenders->setEnterprise($data['enterprise']);
        }
        if( isset($data['cate']) && trim($data['cate']) ){
            $tenders->setCate($data['cate']);
        }
        if( isset($data['content']) && trim($data['content']) ){
            $tenders->setContent($data['content']);
        }
        if( isset($data['price']) && trim($data['price']) ){
            $tenders->setPrice($data['price']);
        }

        if( isset($data['field1']) && trim($data['field1']) ){
            $tenders->setField1($data['field1']);
        }
        if( isset($data['remarks']) && trim($data['remarks']) ){
            $tenders->setRemarks($data['remarks']);
        }

        $tenders->setStatus(Tenders::VALID);
        $tenders->setDate(new \DateTime('now'));
        $tenders->setTime(new \DateTime('now'));
        $tenders->setTenderNum(1);

        $this->tenders = $tenders;
        return $this;
    }

    public function persist(EntityManager $em){
        $em->persist($this->tenders);
    }

}
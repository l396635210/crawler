<?php

namespace SABundle\Controller;

use AppBundle\Entity\CommonCode;
use AppBundle\Entity\Emp;
use AppBundle\Entity\Site;
use SABundle\Entity\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Mail controller.
 *
 * @Route("/super/mail")
 */
class MailController extends Controller
{
    private $mailBody;
    private $tenderMailCurrentCountry;
    private $grabData;

    private function fetchEmps($sendFor){
        $criteria = [
            "status" => true,
            $sendFor => true,
        ];
        return $this->getDoctrine()->getRepository("AppBundle:Emp")
            ->findBy($criteria);
    }

    private function fetchGrabData($entity=null){

        $criteria = "gd.createDate = '" . (new \DateTime())->format("Y-m-d")."' ";
        $criteria .= $entity ? " AND gr.entity = '{$entity}'" : "";

        $repository = $this->getDoctrine()->getRepository("SABundle:GrabData");
        $list = $repository->createQueryBuilder("gd")
            ->join("gd.grabRule","gr")
            ->where($criteria)
            ->getQuery()
            ->getResult();

        $data = [];
        foreach ($list as $key=>$item){
            $data[$item->getGrabRule()->getEntityId()][] = $item;
        }
        $this->grabData = $data;
    }

    private function fetchCompany(){
        $list = $this->getDoctrine()->getRepository("AppBundle:Company")
            ->findBy([
                "status" => true,
            ],["areaId"=>"DESC","countryId"=>"DESC"]);
        $companies = [];
        foreach ($list as $key=>$item){
            $companies[$item->getArea()->getId()][] = $item;
        }
        return $companies;
    }

    private function setTenderMailText($companies, $empCompanies){
        $text = "";
        foreach ($companies as $company){
            if(isset($this->grabData[$company->getId()])&&
                ($empCompanies===null||in_array($company->getId(),$empCompanies))
            ){
                $text .= $this->setTenderMailCountryCompanyName($company);
                $text .= $this->setMailTextEntityGrabData($company);
            }
        }
        return $text;
    }

    private function setTenderMailCountryCompanyName($company){
        $text = "";
        if($this->tenderMailCurrentCountry!=$company->getCountry()->getCountryName()){
            $text .= $this->setMailBody_h3($company->getCountry()->getCountryName());
            $this->tenderMailCurrentCountry = $company->getCountry()->getCountryName();
        }
        $count = count($this->grabData[$company->getId()]);
        $text .= $this->setMailBody_pb("<a target='_blank' href='{$company->getCompanySite()}'>{$company->getCompanyName()}</a>(今日更新：{$count})");
        return $text;
    }

    private function setTenderMailBody($areaCompanies, Emp $emp){
        $this->mailBody = "";
        if($empCompanies = $emp->getCompany()){
            $empCompanies = explode(",",$emp->getCompany());
        }

        foreach ( $areaCompanies as $area => $companies ){
            $text = $this->setTenderMailText($companies, $empCompanies);

            if($text){
                $this->mailBody .= $this->setMailBody_h2($companies[0]->getArea()->getAreaName()) . $text;
            }
        }
    }

    /**
     * @Route("/send/tender",name="sa-mail_send")
     */
    public function sendTenderAction()
    {

        $emps = $this->fetchEmps("isSendTenders");

        $this->fetchGrabData("AppBundle:Company");

        $areaCompanies = $this->fetchCompany();

        foreach ( $emps as $emp ){
            $this->setTenderMailBody($areaCompanies, $emp);
            $this->sendMail($emp,'email/tenders.html.twig','今日招标更新提醒');
        }
        return $this->redirectToRoute("homepage");
    }

    private function fetchSite(){
        $list = $this->getDoctrine()->getRepository(Site::class)
            ->findBy([
                "status" => true,
            ],["categoryId"=>"DESC"]);
        $sites = [];
        foreach ($list as $key=>$item){
            $sites[$item->getCategory()->getId()][] = $item;
        }
        return $sites;
    }

    private function setPostMailBody($categorySites, Emp $emp){
        $this->mailBody = "";
        if($empSites = $emp->getSites()){
            $empSites = explode(",",$emp->getSites());
        }
        foreach ( $categorySites as $category => $sites ){
            $text = $this->setPostMailText($sites, $empSites);

            if($text){
                $this->mailBody .= $this->setMailBody_h2($sites[0]->getCategory()->getName()) . $text;
            }
        }

    }

    protected function setPostMailText($sites, $empSites){
        $text = "";
        foreach ($sites as $site){
                if(isset($this->grabData[$site->getId()])&&
                ($empSites===null||in_array($site->getId(),$empSites))
            ){
                $count = count($this->grabData[$site->getId()]);
                $text .= $this->setMailBody_pb("<a target='_blank' href='{$site->getUrlShow()}'>{$site->getName()}</a>(今日更新：{$count})");
                $text .= $this->setMailTextEntityGrabData($site);
            }
        }
        return $text;
    }

    /**
     * @Route("/send/post",name="sa-mail_send_post")
     */
    public function sendPostAction(){
        //set_time_limit(6000);
        $emps = $this->fetchEmps("isSendInformation");

        $this->fetchGrabData(CommonCode::AppBundle_Site);

        $sites = $this->fetchSite();

        foreach ( $emps as $emp ){
            $this->setPostMailBody($sites, $emp);
            $this->sendMail($emp,'email/information.html.twig', "今日资讯更新提醒");
        }
        return $this->redirectToRoute("homepage");
    }


    private function setMailBody_h2($text){
        return '<h2 style="color: #636363;background:yellow;border-top: 1px solid #eee;" class="zh p">'.$text.'</h2>';
    }

    private function setMailBody_h3($text){
        return '<h3 style="color: red" class="zh p">'.$text.'</h3>';
    }

    private function setMailBody_pb($text){
        return '<p><b style="color: #ccc" class="zh p">'.$text.'</b></p>';
    }

    private function setMailBody_a($href, $text){
        return '<a style="text-decoration:none;color:#00bcd4;" target="_blank" href="'.$href.'">'.$text.'</a>';
    }

    private function setMailTextEntityGrabData($entity){
        $text = "";
        $entityGrabData = $this->grabData[$entity->getId()];
        foreach ($entityGrabData as $k=>$data){
            $grabData = $data->getParsedData(true);
            $pageLink = isset($grabData["page-link"]) ? trim($grabData["page-link"]) : "#";
            $text .= $this->setMailBody_a($pageLink,
                preg_replace("/\s\s+/", " ",trim($grabData["title"]))
                )."<br>";
            if($k==4){
                break;
            }
        }
        return $text;
    }

    protected function sendMail(Emp $emp, $template, $title='今日招标更新提醒'){
        if($this->mailBody){
            $message = \Swift_Message::newInstance()
                ->setSubject($title)
                ->setFrom($this->getParameter('mailer_user'))
                ->setTo(
                    $this->get("kernel")->getEnvironment()=="dev"
                        ? ["lizheng@fonchan.com"]
                        : [$emp->getEmpMail()=>$emp->getEmpName()]
                    //["lizheng@fonchan.com"]
                )->setBody(Mail::body($this->mailBody),'text/html', 'utf-8'/*$this->renderView(
                    $template,
                    array('mailBody' => $this->mailBody)
                ),'text/html'*/);
            return $this->get("mailer")->send($message);
        }
        return null;
    }

}

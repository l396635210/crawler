<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 18:56
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CommonCode;
use AppBundle\Entity\Company;
use AppBundle\Entity\MailLog;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Service\LogTool;

class MailController extends Controller
{
    protected $mailBody;

    protected function setMailBody( $list ){
        $this->mailBody = "";
        $tenderRepository = $this->getDoctrine()->getRepository("AppBundle:Tenders");
        foreach( $list as $item ){
            $company = $item[0];
            $country = $company->getCountry()->getCountryName();
            $area    = $company->getArea()->getAreaName();

            $tenderList = $tenderRepository->findBy(array('companyId'=>$company->getId(),'date'=>new \DateTime('now')),array('id'=>'DESC'));

            $this->mailBody .= isset($lastArea) && $lastArea==$area ? "" : "<h2 style='color: #636363;background:yellow;border-top: 1px solid #eee;' class='zh p'>{$area}</h2>";
            $this->mailBody .= isset($lastCountry) && $lastCountry==$country ? "" : "<h3 style='color: red' class='zh p'>{$country}</h3>";
            $this->mailBody .= "<b class='zh p'>".$company->getCompanyName()."(今日更新".$item['sumCrawler'].")</b><br>";

            $this->setMailBodyTenders($tenderList, $company);
            $lastCountry = $country;
            $lastArea    = $area;
        }
    }
    public function getMailBody(){
        return $this->mailBody;
    }

    protected function setMailBodyTenders($tenderList,Company $company){
        $i = 0;
        $url = $company->getSitesArray();

        foreach( $tenderList as $tender ){

            $url = $tender->getUrl() ? $tender->getUrl() : $url[0];
            if($i==5){
                $this->mailBody .= "    <a style='text-decoration:none;color:#00bcd4;' target='_blank' href='".$url."' class='zh'>更多</a><br>";break;
            }
            $this->mailBody .= "    ·&emsp;<a style='text-decoration:none;color:#00bcd4;' target='_blank' href='{$url}'>".$tender->getTitle()."</a><br>";
            $i++;
        }
    }

    /**
     * @param Request $request
     * @Route("/super/send/tender", name="mail_send_tender")
     */
    public function setTenderMessageAndSendAction(Request $request){

        $logger = new LogTool('applog',$this->get('kernel')->getRootDir());
        $logger->addInfo("进入发送招标邮件方法{...".__FUNCTION__."...}");

        if( $request->request->get('noSend') ){
            return false;
        }
        $empRepository = $this->getDoctrine()->getRepository('AppBundle:Emp');
        $list = $empRepository->findBy([
            "isSendTenders" => true,
        ]);

        $data = [];

        $crawlerLogRepository = $this->getDoctrine()->getRepository('AppBundle:CrawlerLog');
        $devSendFor = $this->devSendFor();
        foreach($list as $item){

            $mailLog = new MailLog();
            $mailLog->setSentTo($item->getEmpMail());
            $mailLog->setSentDate(new \DateTime());
            $mailLog->setSentTime(new \DateTime());
            $mailLog->setSentTitle('今日招标更新提醒');
            $mailLog->setSentType(CommonCode::TENDER_UPDATE);

            $em = $this->getDoctrine()->getManager();
            $em->persist($mailLog);

            $request = new Request(array(
                'company'=>$item->getCompany(),
                'date'=>date('Y-m-d'),
            ),[
                'c.aid' => ["logic"=>"<>", "val"=>"10"],
            ]);
            $crawlerLogs = $crawlerLogRepository->findByCompaniesDate($request, true);

            if($crawlerLogs){
                $this->setMailBody($crawlerLogs);
                $sendTo = $devSendFor ? $devSendFor : array($item->getEmpMail()=>$item->getEmpName());
                $message = \Swift_Message::newInstance()
                    ->setSubject('今日招标更新提醒')
                    ->setFrom($this->getParameter('mailer_user'))
                    ->setTo($sendTo)
                    #->setTo(["lizheng@fonchan.com"])
                    ->setBody($this->renderView(
                        'email/tenders.html.twig',
                        array('mailBody' => $this->getMailBody())
                    ),
                        'text/html');

                $data[$item->getEmpMail()] = ['name'=>$item->getEmpName(), 'isSuccess'=>$isSuccess = $this->send($message, $em)];
            }

        }
        return $this->redirectToRoute('crawler_spider');
    }

    /**
     * @return JsonResponse
     * @Route("/super/send/admin", name="mail_send_admin")
     */
    public function setAdminMessageAndSendAction(){

        $repository = $this->getDoctrine()->getRepository('AppBundle:Company');
        $createDate = new \DateTime("-1 day");
        $list = $repository->findBy(array('createDate'=>$createDate));
        $mailBody = "";
        foreach($list as $item){
            $mailBody .= "{$item->getCompanyName()}:{$item->getCompanySite()}:{$item->getStatusDesc()}\n";
        }

        $mailLog = new MailLog();
        $mailLog->setSentTo('396635210@qq.com');
        $mailLog->setSentDate(new \DateTime());
        $mailLog->setSentTime(new \DateTime());
        $mailLog->setSentTitle('今日增加渠道信息');
        $mailLog->setSentType(CommonCode::COMPANY_UPDATE);
        $em = $this->getDoctrine()->getManager();
        $em->persist($mailLog);
        $message = \Swift_Message::newInstance()
            ->setSubject('今日增加渠道信息')
            ->setFrom($this->getParameter('mailer_user'))
            ->setTo('396635210@qq.com')
            ->setBody($mailBody)
        ;
        $response['data'] = $this->send($message, $em);
        $serializer = $this->get('serializer');
        $response = $serializer->serialize($response, 'json');
        return new JsonResponse($response);
    }

    protected function send(\Swift_Message $message, EntityManager $em){
        $logger = new LogTool('applog',$this->get('kernel')->getRootDir());
        $logger->addInfo("邮件发送给{...".key($message->getTo())."...}");
        $logger->addInfo("邮件内容：\n".$this->mailBody."\n");
        $em->flush();
        return $this->get("mailer")->send($message);
    }

    protected function devSendFor(){
        $send = [];
        if($this->get("kernel")->getEnvironment()=="dev"){
            $send = ["lizheng@fonchan.com"];
        }
        return $send;
    }
}
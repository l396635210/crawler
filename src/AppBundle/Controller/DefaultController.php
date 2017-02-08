<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CommonCode;
use AppBundle\Service\LogTool;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    protected $linkRoles;
    protected $newestTender;
    protected $mailBody= "";


    private function execCrawler($command, LogTool $logTool){

        $data = [];
        if ($command == "crawler"){
            #$logTool->addInfo(">>>开始抓取转推信息");
            #$data['crawlInfoResult'] = $this->forward("AppBundle:Information:asyncGrab");
            #$logTool->addInfo(">>>抓取转推信息结束");
            $logTool->addInfo(">>>开始重构抓取");
            $data['grabData'] = $this->forward('SABundle:GrabData:grab');
            $logTool->addInfo(">>>重构抓取结束");
            $logTool->addInfo(">>>开始招标抓取".date("Y-m-d H:i:s"));
            $data['firstCrawlResult'] = $this->forward('AppBundle:Crawler:asyncGrab');
            $logTool->addInfo("<<<抓取招标结束");
        }
        return $data;
    }

    private function execCrawlerErrorDataAndPushTenders($command, LogTool $logTool){
        $data = [];
        if ($command == "crawlerError"){
            #$logTool->addInfo(">>>开始二次抓取".date("Y-m-d H:i:s"));
            #$data['secondCrawlResult'] = $this->forward('AppBundle:Crawler:crawlTenderForError');
            #$logTool->addInfo("<<<二次抓取结束");
            $logTool->addInfo(">>>开始推送招标信息");
            #$this->forward('CompaniesBundle:Titem:pushTest');
            $data["push_tenders"] = $this->forward('SABundle:Push:tenders',["env"=>$this->get("kernel")->getEnvironment() ]);
            $logTool->addInfo(">>>开始推送展会信息");
            #$this->forward('WordPressBundle:Post:pushEzhan');
            $data["push_zhanhui"] = $this->forward('SABundle:Push:zhanhui',["env"=>$this->get("kernel")->getEnvironment() ]);
        }
        return $data;
    }

    private function execPushPost($command, LogTool $logTool){
        $logTool->addInfo("开始执行媒体转推".date("Y-m-d H:i:s"));
        $data = [];
        if($command == "pushPost"){
            #$data["pushPost"] = $this->forward('WordPressBundle:Post:postTest');
            $data["pushPost"] = $this->forward('SABundle:Push:post',["env"=>$this->get("kernel")->getEnvironment() ]);
        }
        return $data;
    }

    private function execSendMail($command, LogTool $logTool){
        if ($command == "sendMail"){
            $logTool->addInfo(">>>开始发送邮件".date("Y-m-d H:i:s"));
            $er = $this->getDoctrine()->getRepository('AppBundle:MailLog');
            $list = $er->findBy(['sentDate'=>new \DateTime()]);
            if(!$list){
                #$logTool->addInfo(">>>开始发送招标邮件");
                #$data['sendTenderMailResult'] = $this->forward('AppBundle:Mail:setTenderMessageAndSend');
                #$logTool->addInfo("<<<发送招标邮件结束");
                #$logTool->addInfo(">>>开始发送资讯邮件");
                #$data['sendInfoMailResult'] = $this->forward('AppBundle:Emp:sendInformationMailsForEmp');
                #$logTool->addInfo("<<<发送资讯邮件结束");
                $logTool->addInfo(">>>开始发送管理员邮件");
                $data['sendAdminMail'] = $this->forward('AppBundle:Mail:setAdminMessageAndSend');
                $logTool->addInfo("<<<发送管理员邮件结束");
                $logTool->addInfo(">>>开始测试重构招标邮件");
                $data['sendAdminMail'] = $this->forward('SABundle:Mail:sendTender');
                $logTool->addInfo("<<<测试重构招标邮件结束");
                $logTool->addInfo(">>>开始测试重构资讯邮件");
                $data['sendAdminMail'] = $this->forward('SABundle:Mail:sendPost');
                $logTool->addInfo("<<<测试重构资讯邮件结束");
            }
        }

    }

    /**
     * @Route("/", name="homepage")
     * @Method({"GET","POST"});
     */
    public function indexAction(Request $request)
    {
        $data = [];
        if(strtolower(php_sapi_name()) === 'cli' && $command = $request->request->get("command")) {

            $logTool = new LogTool('applog', $this->get('kernel')->getRootDir());
            $logTool->addInfo("开始执行定时任务>>>".date("Y-m-d H:i:s"));
            $command = $request->request->get("command");

            $data["cCrawler"] = $this->execCrawler($command,$logTool);
            $data["cCrawlerPush"] = $this->execCrawlerErrorDataAndPushTenders($command,$logTool);
            $data["cPushPost"] = $this->execPushPost($command, $logTool);
            $data["cSendMail"]= $this->execSendMail($command, $logTool);

            $logTool->addInfo("执行定时任务完成>>>".date("Y-m-d H:i:s"));

            $fs = new Filesystem();
            $fs->chown($this->getParameter('kernel.cache_dir'), 48, true);
            return new JsonResponse($data);
        }
        return $this->render('default/admin.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}

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
            $fs = new Filesystem();
            $fs->chown($this->getParameter('kernel.cache_dir'), 48, true);
            $logTool = new LogTool('applog', $this->get('kernel')->getRootDir());
            $logTool->addInfo("开始执行定时任务>>>".date("Y-m-d H:i:s"));
            $command = $request->request->get("command");

            $data["cCrawler"] = $this->execCrawler($command,$logTool);
            $data["cCrawlerPush"] = $this->execCrawlerErrorDataAndPushTenders($command,$logTool);
            $data["cPushPost"] = $this->execPushPost($command, $logTool);
            $data["cSendMail"]= $this->execSendMail($command, $logTool);

            $logTool->addInfo("执行定时任务完成>>>".date("Y-m-d H:i:s"));

            $fs->chown($this->getParameter('kernel.cache_dir'), 48, true);
            return new JsonResponse($data);
        }
        if($this->getUser()){
            return $this->render('default/admin.html.twig', array(
                'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            ));
        }else{
            return $this->redirectToRoute("fos_user_security_login");
        }

    }

    /**
     * @Route("/test/{id}", name="test")
     * @Method({"GET","POST"});
     */
    public function testAction(Request $request, $id){
        $body = file_get_contents($this->getParameter('kernel.root_dir')."/Resources/data/local/grab-data".$id.".log");
        $arr = (explode("}{", $body));
        echo "<table>";
        echo "<thead>";
        echo "<th>Name</th><th>Category</th><th>Phone</th><th>Website</th>";
        echo "<th>Email</th><th>Manager</th><th>Activities</th>";
        echo "<th>Province</th><th>City</th><th>Address</th>";
        echo "<th>Country</th><th>Fax</th><th>Tender</th>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($arr as $key=>$str){

                $item = "{".$str."}";
            $company = (\GuzzleHttp\json_decode($item, true));
            $details = $company[0]["address"];
            $details = str_replace(
                ["Managing Director:", "Activities:", "Province:", "City:", "Address:"],
                ["oilsns",              "oilsns",       "oilsns",  "oilsns", "oilsns"],
                $details);
            $details = explode("oilsns", $details);

            if(isset($details[5])){
                $manager = $details[1];
                $activities = $details[2];
                $province = $details[3];
                $city = $details[4];
                $address = $details[5];
            }


            echo "<tr>";
            echo "<td>".$company["title"]."</td>";
            echo "<td>".$company[0]["category"]."</td>";
            echo "<td>".$company[0]["info_source"]."</td>";
            echo "<td>".$company[0]["content1"]."</td>";
            echo "<td>".$company[0]["content2"]."</td>";
            echo "<td>".(isset($manager) ? $manager : "")."</td>";
            echo "<td>".(isset($activities) ? $activities : "")."</td>";
            echo "<td>".(isset($province) ? $province : "")."</td>";
            echo "<td>".(isset($city) ? $city : "")."</td>";
            echo "<td>".(isset($address) ? $address : "")."</td>";
            echo "<td>".$company[0]["text_spare"]."</td>";
            echo "<td>".$company[0]["text_spare_1"]."</td>";
            echo "<td>".(isset($company[0]["tender-code"]) ? $company[0]["tender-code"] : "")."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        die;
    }
}

<?php

namespace SABundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\CommonCode;
use AppBundle\Entity\Site;
use AppBundle\Service\LogTool;
use Doctrine\ORM\EntityManager;
use QABundle\Entity\QAList;
use SABundle\Client;
use SABundle\Entity\GrabData;
use SABundle\Entity\GrabRule;
use SABundle\Entity\Push;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZhanhuiBundle\Entity\Channel;

class PushController extends Controller
{
    private $logTool;

    private $grabRuleIds;

    private function setPushQaBody(GrabData $grabData, $tags){
        $request = Push::getQaData($grabData, $tags);
        return $request;
    }

    private function setPushZhanhuiBody(GrabData $grabData, $channels){
        $data = Push::getZhanhuiData($grabData, $channels);
        $request = array(
            'token'=>Push::setToken($data, Push::SALT_ZHANHUI),
            'type' => 'exhibition',
            'data' => json_encode( $data )
        );
        return $request;
    }

    private function setPushTenderBody(GrabData $grabData){
        $data = Push::getTenderData($grabData);
        $request = array(
            'token'=>Push::setToken($data, Push::SALT_TENDER),
            'data' => json_encode( $data )
        );
        return $request;
    }

    private function setPushPostBody(GrabData $grabData){
        $data = Push::getPostData($grabData);
        $request = array(
            'token'=>Push::setToken($data, Push::SALT_POST),
            'type' => 'art',
            'data' => json_encode( $data )
        );
        return $request;
    }

    private function getApi($env, $type){
        if($this->get("kernel")->getEnvironment()=="dev" && $env=="prod"){
            throw new \Exception("操作错误");
        }
        return Push::api($env, $type);
    }

    private function pushCallBack(GrabData $grabData, $_res){
        $_res = str_replace(html_entity_decode("&#xFEFF;"),"",$_res);
        $em = $this->getDoctrine()->getManager();
        $res = \GuzzleHttp\json_decode($_res);
        if((isset($res->Result)&&$res->Result==true)
            || (isset($res->status)&&$res->status)) {
            $grabData->setStatus(2);
            $this->logTool->addInfo("推送成功");
        }else{
            $grabData->setPushResult($_res);
            $this->logTool->addInfo("推送失败：$_res");
        }
        $em->persist($grabData);
        $em->flush();
    }

    private function getGrabData($entity, $entityIds=null){
        $em = $this->getDoctrine()->getManager();
        $this->grabRuleIds = $grabRuleIds = $em->getRepository(GrabRule::class)
            ->findGrabRuleIdsByEntity($entity, $entityIds);
        $grabData = $em->getRepository(GrabData::class)
            ->findBy([
                "createDate" => new \DateTime(),
                "grabRuleId" => $grabRuleIds,
                "status"     => GrabData::PUSH_STATUS_NOT,
            ],["id"=>"DESC"]);
        return $grabData;
    }

    /**
     * @Route("/super/push/zhanhui/{env}", name="sa_push_zhanhui", defaults={"env"="prod"})
     */
    public function zhanhuiAction(Request $request, $env){
        $i = 0;
        //set_time_limit(6000);
        $this->logTool = $logTool = new LogTool('applog', $this->get('kernel')->getRootDir(), 'zhanhui');
        $logTool->addInfo("zhanhuiAction>>>准备推送展会抓取数据");


        $grabData = $this->getGrabData(CommonCode::ZhanhuiBundle_Channel);

        $client = new Client();
        $api = $this->getApi($env, Push::API_ZHANHUI);
        $logTool->addInfo("推送站点：$api");

        $em = $this->getDoctrine()->getManager();
        $channels = $em->getRepository(Channel::class)
            ->findForPush();

        foreach ( $grabData as $item ){
            try{
                $logTool->addInfo("开始推送展会数据GrabData:{$item->getId()}-GrabRule:{$item->getGrabRule()->getEntity()}:{$item->getGrabRule()->getEntityId()}");
                $request = $this->setPushZhanhuiBody($item, $channels);
                $crawler = $client->request("POST",$api, $request);
                $res = $crawler->filter("body")->text();
                $this->pushCallBack($item, $res);
                $i++;
            }catch (\Exception $e){
                $logTool->addWarning($e->getMessage());
            }
        }
        $logTool->addInfo("tenderAction方法执行完成<<<推送展会抓取数据结束");

        $res = ["res"=>$i];
        if(strtolower(php_sapi_name()) === 'cli'){
            return $res;
        }
        return new JsonResponse($res);
    }

    /**
     * @Route("/super/push/tenders/{env}", name="sa_push_tender", defaults={"env"="prod"})
     */
    public function tendersAction(Request $request, $env)
    {
        $i = 0;
        //set_time_limit(6000);
        $this->logTool = $logTool = new LogTool('applog', $this->get('kernel')->getRootDir(), 'oil-companies');
        $logTool->addInfo("进入tenderAction方法>>>准备推送招标抓取数据");

        $grabData = $this->getGrabData(CommonCode::AppBundle_Company);

        $client = new Client();
        $api = $this->getApi($env, Push::API_TENDER);
        $logTool->addInfo("推送站点：$api");
        foreach ( $grabData as $item ){
            try{
                $logTool->addInfo("开始推送招标数据GrabData:{$item->getId()}-GrabRule:{$item->getGrabRule()->getEntity()}:{$item->getGrabRule()->getEntityId()}");
                $request = $this->setPushTenderBody($item);
                $crawler = $client->request("POST",$api, $request);
                $res = $crawler->filter("body")->text();
                $this->pushCallBack($item, $res);
                $i++;
            }catch (\Exception $e){
                $logTool->addWarning($e->getMessage());
            }
        }
        $logTool->addInfo("tenderAction方法执行完成<<<推送招标抓取数据结束");

        $res = ["res"=>$i];
        if(strtolower(php_sapi_name()) === 'cli'){
            return $res;
        }
        return new JsonResponse($res);
    }

    /**
     * @Route("/super/push/posts/{env}", name="sa_push_post", defaults={"env"="prod"})
     */
    public function postAction(Request $request, $env){
        $i = 0;
        //set_time_limit(6000);
        $this->logTool = $logTool = new LogTool('applog', $this->get('kernel')->getRootDir(), 'wp');
        $logTool->addInfo("进入postAction方法:".date("Y-m-d H:i:s").">>>准备推送转推抓取数据");

        $em = $this->getDoctrine()->getManager();
        $entityIds = $em->getRepository(Category::class)
            ->findSiteIdsById(Site::isPushCategory);

        $grabData = $this->getGrabData(CommonCode::AppBundle_Site, $entityIds);
        $pushData = $this->getPushPosts($grabData);

        $api = $this->getApi($env, Push::API_POST);
        $logTool->addInfo("推送站点：$api");
        $client = new Client();
        foreach ($pushData as $item){
            try{
                $logTool->addInfo("开始推送转推数据GrabData:{$item->getId()}-GrabRule:{$item->getGrabRule()->getEntity()}:{$item->getGrabRule()->getEntityId()}");
                $request = $this->setPushPostBody($item);
                $crawler = $client->request("POST",$api, $request);
                $res = trim($crawler->filter("body")->text());

                $this->pushCallBack($item, $res);
                $i++;
            }catch (\Exception $e){
                $logTool->addWarning($e->getMessage());
            }
        }
        $logTool->addInfo("postAction方法执行完成<<<推送转推数据结束");

        $res = ["res"=>$i];
        if(strtolower(php_sapi_name()) === 'cli'){
            return $res;
        }
        return new JsonResponse($res);
    }

    private function getPushPosts($grabData){
        $pushData = null;
        if($grabData){
            $eachNumber = ceil(count($grabData)/CommonCode::BUSINESS_PUSH_TIMES);
            $pushData = $eachNumber ? array_chunk($grabData,$eachNumber) : $grabData;
            //9点开始推送,计算本次推送
            if(isset($pushData[$this->thisTime()])){
                $pushData = is_array($pushData[$this->thisTime()]) ? $pushData[$this->thisTime()] : $pushData;
            }
        }
        return $pushData;
    }

    /**
     * @Route("/super/push/qa/{env}", name="sa_push_qa", defaults={"env"="prod"})
     */
    public function qaAction(Request $request, $env){
        $i = 0;
        //set_time_limit(6000);
        $this->logTool = $logTool = new LogTool('applog', $this->get('kernel')->getRootDir(), 'qa');
        $logTool->addInfo("qaAction>>>准备推送问答抓取数据");

        $grabData = $this->getGrabData(CommonCode::QABundle_QAList);
dump($grabData);die;
        $channels = $this->getDoctrine()->getRepository(QAList::class)
            ->findBy(["status" => true]);
        $tags = [];
        foreach ($channels as $item){
            $tags[$item->getId()] = $item->getTag()->getName();
        }
        $client = new Client();
        $api = $this->getApi($env, Push::API_QA);
        $logTool->addInfo("推送站点：$api");
        foreach ( $grabData as $item ){
            try{
                $logTool->addInfo("开始推送问答数据GrabData:{$item->getId()}-GrabRule:{$item->getGrabRule()->getEntity()}:{$item->getGrabRule()->getEntityId()}");
                $request = $this->setPushQaBody($item, $tags);

                $crawler = $client->request("POST",$api, $request);
                $res = $crawler->filter("body")->text();
                $this->pushCallBack($item, $res);
                $i++;
            }catch (\Exception $e){
                $logTool->addWarning($e->getMessage());
            }
        }
        $logTool->addInfo("tenderAction方法执行完成<<<推送问答抓取数据结束");

        $res = ["res"=>$i];
        if(strtolower(php_sapi_name()) === 'cli'){
            return $res;
        }
        return new JsonResponse($res);
    }

    protected function thisTime(){
        $now = new \DateTime();
        return $now->format("H")- CommonCode::TIMER_BUSINESS_FIRST_PUSH;
    }


}

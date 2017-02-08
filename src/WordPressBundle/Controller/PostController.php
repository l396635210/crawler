<?php

namespace WordPressBundle\Controller;


use AppBundle\Entity\CommonCode;
use AppBundle\Entity\Information;
use AppBundle\Entity\Site;
use AppBundle\Entity\Tenders;
use AppBundle\Service\DomGrab;
use Goutte\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Role\Role;
use AppBundle\Service\LogTool;

class PostController extends Controller
{

    /**
     * @Route("/super/wp/post/push", name="post_push")
     */
    public function pushAction(Request $request)
    {
        $thisPushArticles = $this->fetchThisPushArticles(2);

        die;
        return $this->redirectToRoute('admin');
    }

    protected function fetchThisPushArticles(){
        $siteRepository = $this->getDoctrine()->getRepository("AppBundle:Site");
        $sites = $siteRepository->findBy([
            "categoryId" => Site::isPushCategory
        ]);

        $repository = $this->getDoctrine()->getRepository("AppBundle:Information");

        $list = $repository->findBy([
            'getDate' => new \DateTime(),
            'site'    => $sites,
            #'getDate' => new \DateTime("-1 day") ,
        ],['id'=>'DESC']);

        return $this->fetchThisPushArticlesHelper($list);
    }

    protected function thisTime(){
        $now = new \DateTime();
        return $now->format("H")- CommonCode::TIMER_BUSINESS_FIRST_PUSH;
    }

    protected function fetchThisPushArticlesHelper($list){
        if($list){
            //分12次推送
            $eachNumber = ceil((count($list)/CommonCode::BUSINESS_PUSH_TIMES));
            $list = $eachNumber ? array_chunk($list,$eachNumber) : $list;

            //9点开始推送,计算本次推送
            if(isset($list[$this->thisTime()])){
                $list = is_array($list[$this->thisTime()]) ? $list[$this->thisTime()] : $list;
            }
        }
        return $list;
    }

    protected function getDomGrab(){
        $domGrab = new DomGrab();
        $domGrab->setCURLParameters(array('timeout' => 60, 'headers' => [
            'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
            'Accept'     =>  'text/html,application/xhtml+xml,application/xml;',
        ]));
        return $domGrab;
    }
    /**
     * @Route("/super/wp/post/push/api", name="post_push_api")
     */
    public function postTestAction(Request $request){
        set_time_limit(6000);

        $logger = new LogTool('applog',$this->get('kernel')->getRootDir(),'wp');

// You can now use your logger
        $logger->addInfo('进入postTestAction。。开始推送抓取文章');
        $prodSite = "http://oilsns.com/api.php";
        $devSite = "http://wp.pecans.cn/api.php";
        $domGrab = $this->getDomGrab();

        $list = $this->fetchThisPushArticles();

$logger->addInfo("现在是".(new \DateTime())->format("Y-m-d H:i:s"));
        $em = $this->getDoctrine()->getManager();
        try{
            foreach($list as $item){
                if($item->getStatus()==2){
                    $logger->addInfo($item->getTitle()."已经推送过了");
                    continue;
                }
                $data  = [
                    'id'     => $item->getId(),
                    'title'  => $item->getTitle(),
                    'con'    => $item->getContent() ,
                    'source' => $item->getSource(),
                    'url'    => $item->getLocation(),
                ];

                ksort($data);
                $singstr = implode('-',$data);
                $token = md5($singstr.'Oil.Art');

                $_request = array(
                    'token'=> $token,
                    'type' => 'art',
                    'data' => json_encode( $data )
                );
                $logger->addInfo('推送文章:'.$item->getTitle());
                $crawler = $domGrab->request('POST', $prodSite, $_request );
                $res = $crawler->filter("body")->text();
                $logger->addNotice($prodSite.":推送结果------------------".$res);

                $crawler = $domGrab->request('POST', $devSite, $_request );
                $res = $crawler->filter("body")->text();
                $logger->addNotice($devSite.":推送结果------------------".$res);

                $item->setStatus(2);
                $em->persist($item);
                $em->flush();

            }
        }catch(\Exception $e){
            $logger->addWarning($e);
        }

        $logger->addInfo('推送结束！');

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/super/wp/ezhan/push/api", name="push_ezhan_api")
     */
    public function pushEzhanAction(Request $request){
        set_time_limit(6000);

        $logger = new LogTool('applog',$this->get('kernel')->getRootDir(),'wp');
        $logger->addInfo('进入pushEzhan。。开始推送展会信息');

        $client = new Client();
        $prodSite = "http://oilsns.com/api.php";
        $devSite = "http://wp.pecans.cn/api.php";

        $tendersRepository = $this->getDoctrine()->getRepository("AppBundle:Tenders");
        $em = $this->getDoctrine()->getManager();

        $request->request->set('isPush', true);
        $request->request->set('status', Tenders::VALID);
        $request->request->set('c.aid', ["logic"=>"=", "val"=>"10"]);
        $list = $tendersRepository->findForPush($request);

        try{
            foreach ($list as $item){
                if($item->getStatus()==2){
                    $logger->addInfo($item->getTitle()."已经推送过了");
                    continue;
                }
                if(!$item->getField1()){
                    $logger->addInfo($item->getTitle()."无内容");
                    continue;
                }
                $data  = [
                    'id'     => $item->getId(),
                    'title'  => $item->getField1(),
                    'con1'    => $item->getContent() ,
                    'con2'   => $item->getCate(),
                    'con3'   => preg_replace("/\s\s+/", "@oilsns",$item->getRemarks()),
                    'time' => $item->getEndDate(),
                    'address' => $item->getEnterprise(),
                    'square'    => $item->getCode(),
                    'img'       => $item->getPdf(),
                    'sponsor'    => $item->getPublishDate(),
                    'country' => $item->getCompany()->getCountryId(),
                    'area'    => $item->getCompanyId(),
                    'url'    => $item->getUrl(),
                ];

                ksort($data);
                $singstr = implode('-',$data);
                $token = md5($singstr.'Oil.Art');

                $_request = array(
                    'token'=> $token,
                    'type' => 'exhibition',
                    'data' => json_encode( $data )
                );

                $logger->addInfo('推送展会:'.$item->getTitle());
                $crawler = $client->request('POST', $prodSite, $_request );
                $res = $crawler->filter("body")->text();
                $logger->addNotice($prodSite.":推送结果------------------".$res);

                $crawler = $client->request('POST', $devSite, $_request );

                $res = $crawler->filter("body")->text();
                $logger->addNotice($devSite.":推送结果------------------".$res);


                $item->setStatus(2);
                $em->persist($item);
                //dump($res);
                $em->flush();
            }

        }catch(\Exception $e){
            $logger->addWarning($e);
        }

        $logger->addInfo('推送展会结束！');
        return $this->redirectToRoute('homepage');
    }


}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\Entity\CrawlerLog;
use AppBundle\Entity\Tenders;
use AppBundle\Form\TendersType;
use AppBundle\Service\CompanyService;
use AppBundle\Service\DomGrab;
use AppBundle\Service\LogTool;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\DomCrawler\Crawler;

class CrawlerController extends Controller
{
    const CHECK_NEW_NUM = 5;
    const CRAWLER_MAX_ITEM_PER_PAGE = 50;

    protected $data= "";

    protected function getCompanyNewTendersFromSchema($tendersRepository, $company){
        $tenders = $tendersRepository->findBy(array('companyId'=>$company->getId()), array('id'=>'DESC'), self::CHECK_NEW_NUM);
        $latest = [];
        foreach ($tenders as $tender){
            $latest[] = $tender->getTitle();
        }
        return $latest;
    }

    protected function getCrawlerCountPerPage($count){
        return $count>self::CRAWLER_MAX_ITEM_PER_PAGE ? self::CRAWLER_MAX_ITEM_PER_PAGE : $count;
    }

    /**
     * @Route("/admin/spider", name="crawler_spider")
     */
    public function spiderAction(Request $request)
    {
        $areaRepository = $this->getDoctrine()->getRepository("AppBundle:Area");
        $areaList = $areaRepository->findAll();

        $companyRepository = $this->getDoctrine()->getRepository("AppBundle:Company");
        if($request->query->get('area'))
            $companyList = $companyRepository->findBy(array('areaId'=>$request->query->get('area')));
        else
            $companyList = $companyRepository->findAll();

        $crawlerLogRepository = $this->getDoctrine()->getRepository('AppBundle:CrawlerLog');

        $date = $request->query->get('date') ? $request->query->get('date') : date('Y-m-d');
        $request->query->set('date', $date);
        $list = $crawlerLogRepository->findByCompaniesDate($request, true);

        $sumCrawler = $crawlerLogRepository->findCrawlerCountByDate($request);

        $tenders = new Tenders();
        $form = $this->createForm(TendersType::class, $tenders);

        return $this->render('crawler/index.html.twig', array(
            'areaList'      => $areaList,
            'companyList'   => $companyList,
            'list'          => $list,
            'sumCrawler'    => $sumCrawler,
            'query'         => $request->query->all(),
            'active'        => $request->get('_route'),
            'form'          => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/asyncCrawler", name="crawler_asyncDo")
     */
    public function asyncGrabAction(Request $request){
        $flag = rand(2,5);
        set_time_limit(120000);
        $logger = new LogTool('applog',$this->get('kernel')->getRootDir());

// You can now use your logger
        $logger->addInfo('开始查询渠道列表');
        $companyRepository = $this->getDoctrine()->getRepository("AppBundle:Company");
        $tendersRepository = $this->getDoctrine()->getRepository("AppBundle:Tenders");

        $list = $companyRepository->findForCrawler($request);
        $logger->addInfo('查询渠道列表结束');
        $domGrab = new DomGrab();
        $domGrab->setCURLParameters(array('timeout' => 90, 'headers' => [
            'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
            'Accept'     =>  'text/html,application/xhtml+xml,application/xml;',
        ],'verify'=>false));

        $companyService = new CompanyService();
        $logger->addInfo('开始采集信息');

        foreach($list as $company){
            if($this->jumpCompany($company, $flag)){
                continue;
            }
            $num = 0;
            $crawlerLog = new CrawlerLog();

            try{
                if( $cookies = json_decode($company->getCookie(), true ) ){
                    $domGrab->setCookie($cookies);
                }
                $sites = $company->getSitesArray();
                //数据库中该公司最后self::CHECK_NEW_NUM条招标信息
                $tenders = $this->getCompanyNewTendersFromSchema($tendersRepository, $company);
                $haveNew = true;
                foreach($sites as $site){
                    if( $haveNew ) {
                        $res = $domGrab->getTendersCount($site, $company->getSelectRules());

                        $count = $this->getCrawlerCountPerPage($res['count']);

                        $crawler = $res['crawler'];

                        foreach($domGrab->parseChoice(
                            $crawler,
                            $company->getSelectRules(),
                            $company->getIsDesc()
                        )->slice(0,$count>=1 ? $count : 1) as $k=>$node){

                            $data = [];
                            $node = new Crawler($node);
                            $data['title'] = $title = $domGrab->parseTitle($node, $company->getTitleRules());//标题
                            $data['prefix'] = $company->getPrefixObject();

                            if($title==null){
                                continue;
                            }

                            if( in_array( $title, $tenders ) ){
                                $haveNew = false;
                                break;
                            }
                            /**************抓列表其他规则内容***************/
                            if($company->getListPageOtherRules()){
                                $listPageOtherRules = \GuzzleHttp\json_decode($company->getListPageOtherRules());
                                $data = $this->getListOtherData($domGrab, $crawler, $node, $listPageOtherRules, $data, $k, true, $company->getIsDesc());
                            }
                            /**************抓列表其他规则内容end***************/

                            /**************详情链接页面***************/
                            if($company->getLinkRules()){
                                $data['uri'] = $uri = $domGrab->getUri($crawler, $node, $company->getLinkRules(), $k, $company->getIsDesc());

                                if($company->getDetailPageRules() || $company->getContentRules()){
                                    $detailPageRules = \GuzzleHttp\json_decode($company->getDetailPageRules());
                                    $res = $domGrab->getTendersCount($uri,  $company->getContentRules());
                                    $count = $res['count']; $crawlerChild = $res['crawler'];

                                    if($count){
                                        $data['content'] = $company->getContentRules() ?
                                            trim($domGrab->parseContent($crawlerChild, $company->getContentRules())) :
                                            "";
                                        $data = $this->getListOtherData($domGrab, $crawlerChild, $crawlerChild, $detailPageRules, $data, $k, true);

                                    }
                                }
                            }else{
                                $data['uri'] = $uri = null;
                            }
                            /**************详情链接页面end***************/

                            $companyService->addTenders($company, $data, $domGrab);
                            $num++;
                        }
                    }
                }
                $this->data .= $company->getCompanyName().":".$num."条数据\n";
                $crawlerLog->setCrawlerCount($num);
                $crawlerLog->setIsSuccess(true);
                $logger->addInfo("采集@{$company->getCompanyName()}信息成功:{$num}");

                //insert
                $crawlerLog->setCompany($company);
                $crawlerLog->setDate(new \DateTime('now'));
                $crawlerLog->setTime(new \DateTime('now'));

                $em = $this->getDoctrine()->getManager();
                $em->persist($crawlerLog);
                $companyService->persistTenders($em);
                $em->flush();

                $companyService->removeCompany();

           }catch(\Exception $e){
                $this->data .= $company->getCompanyName()."抓取数据失败\n";
                $crawlerLog->setCrawlerCount($num);
                $crawlerLog->setIsSuccess($num>0 ? true : false);
                $crawlerLog->setException(substr($e, 0, 300));

                $logger->addWarning("采集@{$company->getCompanyName()}信息失败");
                $logger->addWarning("错误原因：{".substr($e, 0, 300)."}");
            }


        }
        $logger->addInfo('采集信息结束');

        $response['data'] = $this->data;
        $serializer = $this->get('serializer');
        $response = $serializer->serialize($response, 'json');
        return new JsonResponse($response);
    }

    private function jumpCompany(Company $company, $flag){
        sleep(rand(2,5));
        $result = false;
        if($company->getId()<316 || $company->getId()>379){
            $result = true;
        }
        if(($company->getId()>=316 && $company->getId()<=379) && $flag!=5){
            $result = true;
        }
        if(!$company->getSelectRules()){
            $result = true;
        }
        return $result;
    }

    public function crawlTenderForErrorAction(Request $request){
        $er = $this->getDoctrine()->getRepository('AppBundle:CrawlerLog');
        $request->request->set('isSuccess', false);
        $request->query->set('date', date('Y-m-d'));
        $list = $er->findByCompaniesDate($request, true);
        foreach( $list as $item ){
            $request->request->set('company', $item[0]->getCompany()->getId());
            $response = $this->asyncGrabAction($request);
        }
        return $response;
    }

    /**
     * @Route("/admin/testCrawler", name="crawler_test")
     */
    public function testCrawlerAction(Request $request){
        set_time_limit(6000);
        $company = $request->request->get('company');

        $domGrab = new DomGrab();
        #$domGrab->getClient()->setDefaultOption('config/curl/'.CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36');

        $domGrab->setCURLParameters(array(
                'timeout' => 120,
                'headers' => [
                'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
                'Accept'     =>  'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                ],
            'verify'=>false,
            /*
            'proxy' => [
                'http' => "pptp://45.120.159.180:1723",
                'auth' => ["ifonchan","aaaaaa"]
            ]
            */
        ));
        if( isset($company['cookie']) && $cookies = json_decode($company['cookie'], true ) ){
            $domGrab->setCookie($cookies);
        }
       # $company['siteUrl'] = 'http://www.brc.sy/tndrs/EnTndrs.php?TndrType=2&pn=1';
        $res = $domGrab->getTendersCount($company['siteUrl'],  $company['selectRules']);

        $count = $this->getCrawlerCountPerPage($res['count']); $crawler = $res['crawler'];

        $data = array();

        if($count){

            #try{
            foreach($domGrab->parseChoice($crawler, $company['selectRules'], $company['isDesc'])->slice(0, $count) as $k=>$node){

                $node = new Crawler($node);
                $data[$k]['title'] = $domGrab->parseTitle($node, $company['titleRules']); //抓标题
                $data['prefix'] = $prefix = trim($company['prefix']) ? \GuzzleHttp\json_decode($company['prefix']) : (object)null;
                if($data[$k]['title']==null || (ord($data[$k]['title'])==194 && strlen($data[$k]['title'])<=2)){
                    unset($data[$k]);continue;
                }

                /**************抓列表其他规则**************/
                if(trim($company['listPageOtherRules'])){
                    $listPageOtherRules = \GuzzleHttp\json_decode($company['listPageOtherRules']);
                    $data = $this->getListOtherData($domGrab, $crawler, $node, $listPageOtherRules, $data, $k,false, $company['isDesc']);
                }
                /**************抓列表其他规则end**************/

                if( trim($company['linkRules']) ){

                    $data[$k]['url'] = $uri = isset($prefix->link)
                        ? $prefix->link.$domGrab->getUri($crawler, $node, $company['linkRules'], $k, $company['isDesc'])
                        : $domGrab->getUri($crawler, $node, $company['linkRules'], $k, $company['isDesc']);

                    if(trim($company['contentRules']) || trim($company['detailPageRules'])){

                        $res = $domGrab->getTendersCount($uri,  $company['contentRules']);
                        $count = $res['count']; $crawlerChild = $res['crawler'];

                        if($count){
                            $data[$k]['content'] = trim($domGrab->parseContent($crawlerChild, $company['contentRules']));

                            $detailPageRules = \GuzzleHttp\json_decode(trim($company['detailPageRules']));
                            if(isset($company["sourceRules"])&&trim($company["sourceRules"])){
                                $data[$k]['source'] = trim($domGrab->parseRules($crawlerChild, $company['sourceRules'])->text());
                            }
                            $data = $this->getListOtherData($domGrab, $crawlerChild, $crawlerChild, $detailPageRules, $data, $k);
                        }

                    }

                }

            }
            /*}catch(\Exception $e){

            }*/
        }
        $response['data'] = $data;
        $serializer = $this->get('serializer');
        $response = $serializer->serialize($response, 'json');
        return new JsonResponse($response);
    }

    protected function getListOtherData(DomGrab $domGrab, $crawler, $node, $listPageOtherRules, $data, $k, $insert=false, $isDesc=false){

        if($listPageOtherRules){
            foreach($listPageOtherRules as $key=>$val){

                if($key=='pdf'){
                    $val = $uri = isset($data['prefix']->pdf)
                        ? $data['prefix']->pdf.$domGrab->getUri($crawler, $node, $val, $k, $isDesc)
                        : $domGrab->getUri($crawler, $node, $val, $k, $isDesc);

                    /*
                    $file = file_get_contents($uri);
                    $path = $this->get('kernel')->getRootDir()."/../web/bundles/app/attach/";
                    $fileName = substr($uri,strripos($uri,"/")+1);

                    file_put_contents($path.$fileName, $file);
                    */
                }else{
                    $val = $domGrab->parseContent($node, $val);
                }
                if($insert){
                    $data[$key] = $val;
                }else{
                    $data[$k][$key] = $val;
                }

            }
        }

        return $data;
    }

}

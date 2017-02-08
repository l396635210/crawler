<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Information;
use AppBundle\Service\DomGrab;
use AppBundle\Service\LogTool;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;

class InformationController extends Controller
{
    const CRAWLER_MAX_ITEM_PER_PAGE = 20;

    const CHECK_NEW_NUM = 5;

    protected function getSiteNewMsgFromSchema($informationRepository, $site){
        $tenders = $informationRepository->findBy(array('siteId'=>$site->getId()), array('id'=>'DESC'), self::CHECK_NEW_NUM);
        $latest = [];
        foreach ($tenders as $tender){
            $latest[] = $tender->getTitle();
        }
        return $latest;
    }

    protected function getCrawlerCountPerPage($count){
        return $count>self::CRAWLER_MAX_ITEM_PER_PAGE ? self::CRAWLER_MAX_ITEM_PER_PAGE : $count;
    }

    private $insertData = [];
    /**
     * @Route("/admin/article/information/list", name="information_list")
     */
    public function spiderAction(Request $request)
    {
        $informationRepository = $this->getDoctrine()->getRepository("AppBundle:Information");
        $pagination = $informationRepository->findByPage($this->get('knp_paginator'), $request);

        return $this->render('wordpress/information/list.html.twig', array(
            'pagination'    => $pagination,
            'active'        => 'information',
        ));
    }

    /**
     * @Route("/admin/article/information/asyncCrawler", name="information_crawler")
     */
    public function asyncGrabAction(Request $request){

        set_time_limit(6000);
        $logger = new LogTool('applog', $this->get('kernel')->getRootDir(),'wp');

// You can now use your logger
        $logger->addInfo('开始查询渠道列表');
        $siteRepository = $this->getDoctrine()->getRepository("AppBundle:Site");
        $informationRepository = $this->getDoctrine()->getRepository("AppBundle:Information");


        $list = $siteRepository->findAll();

        $logger->addInfo('查询渠道列表结束');
        $domGrab = new DomGrab();
        $domGrab->setCURLParameters(array('timeout' => 90, 'headers' => [
            'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
            'Accept'     =>  'text/html,application/xhtml+xml,application/xml;',
        ],'verify'=>false));

        $logger->addInfo('开始采集信息');
        foreach($list as $site){
            if(!$site->getSelectRules()){
                continue;
            }
            try{

                $urls = $site->getUrlArr();
                //数据库中该公司最后一条招标信息

                $articles = $this->getSiteNewMsgFromSchema($informationRepository, $site);
                $haveNew = true;

                foreach($urls as $url){
                    if( $haveNew ){
                        $insertInformation = [];
                        $res = $domGrab->getTendersCount($url, $site->getSelectRules());
                        $count = $this->getCrawlerCountPerPage($res['count']);
                        $crawler = $res['crawler'];
                        foreach($domGrab->parseChoice($crawler, $site->getSelectRules())
                                    ->slice(0,$count==1 ? 1 : $count-1) as $node
                            ){

                            $node = new Crawler($node);
                            $insertInformation['title'] = $title = $domGrab->parseTitle($node, $site->getTitleRules());
                            if($title==null){
                                continue;
                            }

                            if( in_array( $title, $articles ) ){
                                $haveNew = false;
                                break;
                            }

                            if($title){
                                $link = $domGrab->getUri($crawler, $node, $site->getLinkRules());

                                $insertInformation['location'] = $site->getLinkPrefix().$link;
                                $res = $domGrab->getTendersCount($link,  $site->getContentRules());
                                $count = $res['count']; $detailPage = $res['crawler'];

                                if($count && trim($site->getSourceRules())){
                                    $source  = trim($domGrab->parseContent($detailPage, $site->getSourceRules()));
                                }else{
                                    $source = "";
                                }
                                if($count || trim($site->getContentRules())){
                                    $content = trim($domGrab->parseContent($detailPage, $site->getContentRules()));
                                }else{
                                    $content = "";
                                }

                                $insertInformation['source'] = trim($source);
                                $insertInformation['content'] = trim($content);

                                $this->setInformation($insertInformation, $site);

                            }
                        }
                    }
                }
                $this->flush();
                $logger->addInfo("采集@{$site->getId()}---{$site->getName()}信息成功");

            }catch(\Exception $e){
                $logger->addWarning("采集@{$site->getName()}信息失败");
                $logger->addWarning("错误原因：{".substr($e, 0, 300)."}");
            }

        }

        $logger->addInfo('采集信息结束');

        $this->addFlash(
            'notice',
            '添加采集完成!'
        );

        return $this->redirectToRoute('information_list');
    }

    /**
     * @Route("/admin/article/information/edit/{id}", name="information_edit")
     */
    public function edit(Request $request, $id){
        $informationRepository = $this->getDoctrine()->getRepository("AppBundle:information");
        $details = $informationRepository->find($id);

        return $this->render('wordpress/information/create.html.twig', array(
            'details'          => $details,
        ));
    }

    protected function setInformation($insertInformation, $site){
        $information = new Information();
        $information->setTitle($insertInformation['title']);
        $information->setContent($insertInformation['content']);
        $information->setSource($insertInformation['source']);
        $information->setGetDate(new \DateTime('now'));
        $information->setLocation($insertInformation['location']);
        $information->setSite($site);
        $information->setStatus(true);
        $information->setRemarks("");

        array_unshift($this->insertData, $information);
    }

    protected function flush(){
        $em = $this->getDoctrine()->getManager();
        foreach($this->insertData as $item){
            $em->persist($item);
        }
        $em->flush();
    }
}

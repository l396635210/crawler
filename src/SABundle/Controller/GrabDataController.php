<?php

namespace SABundle\Controller;

use AppBundle\Service\LogTool;
use SABundle\Client;
use SABundle\Entity\GrabFields;
use SABundle\Entity\GrabLog;
use SABundle\Entity\GrabRule;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SABundle\Entity\GrabData;
use SABundle\Form\GrabDataType;

/**
 * GrabData controller.
 *
 * @Route("/admin/sa/grab-data")
 */
class GrabDataController extends Controller
{

    private $logTool;
    private $grabDatas = [];
    private $grabLog;
    private $noNew;
    /**
     * Lists all GrabData entities.
     *
     * @Route("/", name="admin_sa_grab-data_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $grabDatas = $em->getRepository('SABundle:GrabData')->findAll();

        return $this->render('SABundle:GrabData:index.html.twig', array(
            'grabDatas' => $grabDatas,
        ));
    }

    /**
     * Creates a new GrabData entity.
     *
     * @Route("/new", name="admin_sa_grab-data_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $grabData = new GrabData();
        $form = $this->createForm(new GrabDataType(), $grabData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grabData);
            $em->flush();

            return $this->redirectToRoute('admin_sa_grab-data_show', array('id' => $grabData->getId()));
        }

        return $this->render('SABundle:GrabData:new.html.twig', array(
            'grabData' => $grabData,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a GrabData entity.
     *
     * @Route("/{id}", name="admin_sa_grab-data_show")
     * @Method("GET")
     */
    public function showAction(GrabData $grabDatum)
    {
        $deleteForm = $this->createDeleteForm($grabDatum);

        return $this->render('SABundle:GrabData:show.html.twig', array(
            'grabDatum' => $grabDatum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GrabData entity.
     *
     * @Route("/{id}/edit", name="admin_sa_grab-data_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GrabData $grabDatum)
    {
        $deleteForm = $this->createDeleteForm($grabDatum);
        $editForm = $this->createForm(new GrabDataType(), $grabDatum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grabDatum);
            $em->flush();

            return $this->redirectToRoute('admin_sa_grab-data_edit', array('id' => $grabDatum->getId()));
        }

        return $this->render('SABundle:GrabData:edit.html.twig', array(
            'grabDatum' => $grabDatum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a GrabData entity.
     *
     * @Route("/{id}", name="admin_sa_grab-data_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GrabData $grabDatum)
    {
        $form = $this->createDeleteForm($grabDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($grabDatum);
            #$em->flush();
        }

        return $this->redirectToRoute('admin_sa_grab-data_index');
    }

    /**
     * Creates a form to delete a GrabData entity.
     *
     * @param GrabData $grabDatum The GrabData entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GrabData $grabDatum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sa_grab-data_delete', array('id' => $grabDatum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function grabCriteria(Request $request){
        $criteria = ["status" => 1,];
        if($request->get("entity")){
            $criteria["entity"] = GrabRule::getRequestMapping($request->get("entity"));
            if($request->get("entity_id")){
                $criteria["entityId"] = $request->get("entity_id");
            }
        }
        return $criteria;
    }
    /**
     * @Route("/grab/action/{entity}/{entity_id}",
     *     name="sa_grab-data_test",
     *     defaults={"entity"=null,"entity_id"=null}
     *     )
     */
    public function grabAction(Request $request){

        $this->logTool = new LogTool('applog',$this->get('kernel')->getRootDir(), 'grab-data');
        $this->logTool->addInfo("进入GrabData:grabAction方法》》》》：");
        #set_time_limit(60000);
        $em = $this->getDoctrine()->getManager();
        $grabRules = $em->getRepository(GrabRule::class)->findBy($this->grabCriteria($request));

        $res = $this->grab($request, $grabRules);
        $response = new JsonResponse();
        $response->setData($res);

        return $response;
    }

    private function grab(Request $request, $grabRules){
        $res = [];
        $em = $this->getDoctrine()->getManager();
        foreach ($grabRules as $grabRule){
            //try{
                /*
                if(rand(2,5)==5){
                    continue;
                }
                */
                $this->noNew = false;
                $latest = $em->getRepository(GrabData::class)
                    ->getLatestGrabData($grabRule);
                $this->grabLog = $em->getRepository(GrabLog::class)
                    ->setGrabLog($grabRule);
                $this->logTool->addInfo("开始抓取{$grabRule->getEntity()}:{$grabRule->getEntityId()}");
                $urls = $grabRule->getUrlsArr();
                foreach ($urls as $url){
                    //sleep(rand(2,7));
                    $pageData = $this->getAllPageData($url, $grabRule->getData(), $grabRule->getPrefix(), $latest);
                    $this->setInsertGrabDatas($pageData,$grabRule);
                    if($this->noNew){
                        break;
                    }
                }
                $this->insertGrabDatas();
/*
            }catch (\Exception $e){
                $this->logTool->addWarning("抓取{$grabRule->getEntity()}:{$grabRule->getEntityId()}失败");
                $em->persist($this->grabLog->setGrabLogException($e));
                $em->flush();
                $res[]["err"] = $e->getCode();
                $res[]["msg"] = $e->getMessage();
            }
*/
        }

        return $res;
    }

    private function pageDateInSchema($res, $latest){
        $latestGrabTitle = [];
        $latestGrabLink = [];
        foreach ($latest as $item){
            $data = \GuzzleHttp\json_decode($item->getData(),true);
            $latestGrabTitle[] = trim($data['title']);
            if(isset($data['page-link'])){
                $latestGrabLink[] = trim($data['page-link']);
            }
        }
        return isset($res["page-link"])
            ? in_array(trim($res["title"]),$latestGrabTitle) &&  in_array(trim($res["page-link"]),$latestGrabLink)
            : in_array(trim($res["title"]),$latestGrabTitle);
    }

    private function setInsertGrabDatas(array $pageData, GrabRule $grabRule){
        foreach ($pageData as &$item){
            $grabData = new GrabData();
            $grabData->setGrabRule($grabRule);
            $grabData->setData(\GuzzleHttp\json_encode($item));
            $grabData->setCreateDate(new \DateTime());
            $grabData->setCreateTime(new \DateTime());
            $this->grabDatas[] = $grabData;
        }
    }

    private function insertGrabDatas(){
        $em = $this->getDoctrine()->getManager();

        if($this->grabDatas){
            krsort($this->grabDatas);
            foreach ($this->grabDatas as $grabData){
                $em->persist($grabData);
                $em->flush();
            }
        }

        $this->grabLog->setCount(count($this->grabDatas));
        $em->persist($this->grabLog);
        $em->flush();
        $this->logTool->addWarning("抓取成功：".count($this->grabDatas));
        $this->grabDatas = null;
    }

    private function getAllPageData($url,$rule, $prefix, $latest=null){
        $this->logTool->addInfo("抓取{$url}");
        if($prefix){
            $prefix = \GuzzleHttp\json_decode($prefix,true);
        }
        $topLevPageRule = $this->getRule(1, $rule);
        $pageData = $this->getPageData($topLevPageRule, $url, $prefix, $latest);

        $Lev2PageRule = $this->getRule(2, $rule);
        if($Lev2PageRule){
            $pageData = $this->joinLev2PageData($Lev2PageRule, $pageData, $prefix);
        }
        return $pageData;
    }
    /**
     * @param Request $request
     * @Route("/test",name="sa_grabData_test")
     */
    public function testGrabAction(Request $request){
        set_time_limit(6000);
        $pageData = $this->getAllPageData(
            $this->getTestUrl($request->request->get("urls")),
            $request->request->get("rule"),
            $request->request->get("prefix")
        );
        $response = new JsonResponse();
        $response->setData($pageData);

        return $response;
    }

    private function getTestUrl($urls){
        $urls = explode(",",$urls);
        return $urls[ rand( 0, count($urls)-1 ) ];
    }

    private function getRule($lev,$ruleJsonString){

        $rules = \GuzzleHttp\json_decode($ruleJsonString,true);
        return $this->getListRule($lev, $rules);
    }

    private function getListRule($lev, $rules){
        $er = $this->getDoctrine()->getRepository(GrabFields::class);
        foreach ($rules[$lev] as $key=>$rule){
            $grabField = $er->find($key);
            if($grabField->isList()){
                $rules[$lev]["list"] = $rule;
                unset($rules[$lev][$key]);
            }
        }
        return $rules[$lev];
    }

    private function getData(Crawler $node, $data=null){
        if(!$node || !$node->count()){
            return "";
        }
        if($data){
            $grabData = $node->attr($data);
        }else{
            $grabData = $node->text();
        }
        return trim($grabData);
    }

    private function evalRule(Crawler $crawler, $rule){

        if(strstr($rule, "->")){
            $rule = str_replace("$","filter",$rule);
            $rule = preg_replace("/reduce\((\d+),\s*(=|!)\)/","reduce(function (\$node, \$i) { return (\$i % $1) $2= 0; });", $rule);

            $node = eval('return $crawler->'.$rule.";");
        }else{
            $node = $crawler->filter($rule);
        }
        return $node;
    }


    private function getResource(Crawler $crawler, $rules, $prefix){
        $resources = [];
        foreach ($rules as $key=>$rule){
            $grabFields = $this->getDoctrine()->getRepository(GrabFields::class)->find($key);
            $node = $this->evalRule($crawler, $rule);

            if($grabFields->isLink()){
                $resource = $this->getData($node,"href");
            }elseif($grabFields->isImg()){
                $resource = $this->getData($node, "src");
            }else{
                $resource = $this->getData($node);
            }
            $resources[$grabFields->getName()] = isset($prefix[$grabFields->getName()]) && !strstr($resource, "http") ? $prefix[$grabFields->getName()].$resource : $resource;
        }
        $arr = array_unique($resources);
        if(count($arr)==1 && !(array_values($arr)[0])){
            $resources = null;
        }
        return $resources;
    }

    private function reduceCssAndJs(Crawler $crawler){
        //去除script标签
        $crawler->filter('style')->each(function (Crawler $node, $i) {
            $node->getNode(0)->parentNode->removeChild($node->getNode(0));
        });
        $crawler->filter('script')->each(function (Crawler $node, $i) {
            $node->getNode(0)->parentNode->removeChild($node->getNode(0));
        });
        return $crawler;
    }
    private function getPageData($pageRule, $url, $prefix="", $latest=null, $cookieString = null){
        $client = new Client();
dump(trim($url));
        $crawler = $client->setCookie($cookieString)
            ->setCURLParameters([])->request("GET",trim($url));

        if(isset($pageRule["list"])&&$pageRule["list"]){
            $listRule = $pageRule["list"];
            unset($pageRule["list"]);
            if(!$this->evalRule($crawler,$listRule)->count()){
                $crawler = $client->request("POST",trim($url));
            }
            $crawler = $this->reduceCssAndJs($crawler);
            $data = $this->evalRule($crawler,$listRule)->each(function (Crawler $node, $i) use($pageRule, $latest, $prefix) {
                $res = $this->getResource($node, $pageRule, $prefix);
                if($latest&&$this->pageDateInSchema($res, $latest)){
                    $this->noNew = true;
                    return false;
                }
                return $res;
            });
        }else{
            $crawler = $this->reduceCssAndJs($crawler);
            $data = $this->getResource($crawler, $pageRule, $prefix);
        }

        $newData = $this->getNewGrabData($data);

        return $newData;
    }

    private function getNewGrabData($data){
        $hasNew = true;
        if($data){
            foreach ($data as $k=>$item){
                if($item===false){
                    $hasNew = false;
                }
                if(!$hasNew || is_null($item)){
                    unset($data[$k]);
                }
            }
        }
        return $data;
    }

    private function joinLev2PageData($lev2PageRule, $pageData, $prefix){

        foreach ($pageData as $key=>$item){
            if(isset($item[GrabFields::FIELD_LINK])){
                $pageData[$key][] = $this->getPageData($lev2PageRule, $item[GrabFields::FIELD_LINK], $prefix);
            }
        }
        return $pageData;
    }
}

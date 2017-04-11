<?php

namespace QABundle\Controller;

use QABundle\Entity\QAList;
use SABundle\Client;
use SABundle\Entity\GrabData;
use SABundle\Entity\GrabRule;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/admin/qa/index")
     */
    public function indexAction()
    {
        return $this->render('QABundle:Default:index.html.twig');
    }

    /**
     * @Route("/admin/qa/test")
     */
    public function testAction(){

        $em = $this->getDoctrine()->getManager();
        $grabRules = $em->getRepository(GrabRule::class)
            ->findBy([
                "entity" => "QABundle:QAList"
            ]);

        $grabRuleIds = [];
        $entityIds = [];
        foreach ($grabRules as $grabRule){
            $grabRuleIds[] = $grabRule->getId();
            $entityIds[] = $grabRule->getEntityId();
        }
        $list = $em->getRepository(GrabData::class)
            ->findBy([
                "grabRuleId" => $grabRuleIds
            ],["id"=>"DESC"],50);

        $qaList = $em->getRepository(QAList::class)
            ->findBy([
                "id" => $entityIds
            ]);
        $tags = [];
        foreach ($qaList as $item){
            $tags[$item->getId()] = $item->getTag()->getName();
        }
        foreach ($list as $item){
            $data = \GuzzleHttp\json_decode($item->getData(), true);
            $data["tag"] = $tags[$item->getGrabRule()->getEntityId()];
            dump($data);

            $client = new Client();
            $crawler = $client->request("POST","http://wenda.pecans.cn/?qa=curl", $data);
            dump($crawler);
            //$res = $crawler->filter("body")->text();

        }
        die;
    }

    /**
     * @Route("/a/api")
     * @Method({"Post"})
     */
    public function apiAction(Request $request){
        return new JsonResponse(['id'=>1]);
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CommonCode;
use AppBundle\Entity\Site;
use AppBundle\Form\SiteType;
use AppBundle\Service\DomGrab;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

class SiteController extends Controller
{
    /**
     * @Route("/admin/article/site/list", name="site_list")
     */
    public function listAction(Request $request)
    {
        $siteRepository = $this->getDoctrine()->getRepository('AppBundle:Site');
        $list = $siteRepository->findAll();

        // replace this example code with whatever you need
        return $this->render('wordpress/site/list.html.twig', array(
            'active'    => 'app_site',
            'list'      => $list,
        ));
    }

    /**
     * @Route("/admin/article/site/create", name="site_create")
     */
    public function createAction(Request $request)
    {
        $site = new Site();
        $form = $this->createForm(SiteType::class, $site);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){

            $em = $this->getDoctrine()->getManager();
            $site = $form->getData();
            $site->setStatus(true);
            $em->persist($site);
            //$this->setSites($company, $em);

            $em->flush();
            $this->addFlash(
                'notice',
                '添加'.$site->getName().'成功!'
            );

            return $this->redirectToRoute('site_list');
        }
        // replace this example code with whatever you need
        return $this->render('wordpress/site/create.html.twig', array(
            'active' => 'app_site',
            'action' => 'Create',
            'form'   => $form->createView(),
            'title'  => '创建内容源',
        ));
    }

    /**
     * @Route("/admin/article/site/edit/{id}", name="site_edit")
     */
    public function editAction(Request $request, $id)
    {
        $siteRepository = $this->getDoctrine()->getRepository('AppBundle:Site');
        $site = $siteRepository->find($id);
        $form = $this->createForm(SiteType::class, $site);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){

            $em = $this->getDoctrine()->getManager();
            $site = $form->getData();
            $em->persist($site);
            //$this->setSites($company, $em);
            $em->flush();

            $this->addFlash(
                'notice',
                '修改'.$site->getName().'成功!'
            );

            return $this->redirectToRoute('site_list');
        }

        // replace this example code with whatever you need
        return $this->render('wordpress/site/create.html.twig', array(
            'active' => 'app_site',
            'action' => 'Edit',
            'form'   => $form->createView(),
            'title'  => '修改内容源',
        ));
    }

    /**
     * @Route("/admin/article/site/delete/{id}", name="site_delete")
     */
    public function deleteAction(Request $request, $id){

        $companyRepository = $this->getDoctrine()->getRepository('AppBundle:Company');
        $company = $companyRepository->find($id);
        $company->setStatus(0);
        $em = $this->getDoctrine()->getManager();
        $em->persist($company);

        $em->flush();

        return $this->redirectToRoute('company_list');
    }


    /**
     * @Route("/admin/article/site/test", name="site_test")
     */
    public function testCrawler(Request $request){
        $site = $request->request->get('site');
        $site["siteUrl"] = $site["urlShow"];
        $site["isDesc"]  = 0;
        $request->request->set("company", $site);
        return $this->forward("AppBundle:Crawler:testCrawler");
    }

    /**
     * @Route("/admin/source/set/grab-rule/{id}",
     *      name="source_set_grab_rule",
     *      requirements={"id":"\d+"}
     * )
     */
    public function setGrabRuleAction(Request $request){
        $criteria = [
            "entity" => CommonCode::AppBundle_Site,
            "entityId" => $request->get("id"),
        ];
        $em = $this->getDoctrine()->getManager();
        $grabRule = $em->getRepository("SABundle:GrabRule")->findOneBy($criteria);
        $criteria["back"] = "site_list";

        if($grabRule){
            $response = $this->forward("SABundle:GrabRule:edit",["grabRule"=>$grabRule],$criteria);
        }else{
            $response = $this->forward("SABundle:GrabRule:new",[],$criteria);
        }

        return $response;
    }
}

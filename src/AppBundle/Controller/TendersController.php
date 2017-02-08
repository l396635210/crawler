<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CrawlerLog;
use AppBundle\Entity\Tenders;
use AppBundle\Form\TendersType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TendersController extends Controller
{
    /**
     * @Route("/admin/tenders/list/{page}", name="tenders_list", defaults={"page" = 1})
     */
    public function listAction(Request $request, $page){

        $companyRepository = $this->getDoctrine()->getRepository("AppBundle:Company");
        $companyList = $companyRepository->findByUser($this->getUser());

        $form = $this->createForm(TendersType::class, new Tenders());

        $tendersRepository = $this->getDoctrine()->getRepository('AppBundle:Tenders');
        $date = $request->query->get('date') ? new \DateTime($request->query->get('date')) : "";
        $pagination = $tendersRepository->findByPage($this->get('knp_paginator'), $request);
        return $this->render('tenders/list.html.twig', [
            'pagination'    => $pagination,
            'active'        => $request->get('_route'),
            'date'          => $date,
            'companyList'   => $companyList,
            'company'       => $request->query->get('company'),
            'remarks'       => $request->query->get('remarks'),
            'form'          => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/tenders/create", name="tenders_doCreate")
     */
    public function doCreateAction( Request $request ){
        $tenders = new Tenders();
        $form = $this->createForm(TendersType::class, $tenders);

        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() ){
            $em = $this->getDoctrine()->getManager();
            $tenders = $form->getData();
            $tenders->setDate(new \DateTime());
            $tenders->setTime(new \DateTime());
            $tenders->setTenderNum(1);
            $tenders->setStatus(1);

            $crawlerLog = new CrawlerLog();
            $crawlerLog->setCompany($form->getData()->getCompany());
            $crawlerLog->setCrawlerCount(1);
            $crawlerLog->setIsSuccess(true);
            $crawlerLog->setDate(new \DateTime());
            $crawlerLog->setTime(new \DateTime());

            $em->persist($crawlerLog);
            $em->persist($tenders);
            $em->flush();

            $response['data'] = $tenders->getTitle() ? '添加招标:'.$tenders->getTitle().'成功!' : false;
            $serializer = $this->get('serializer');
            $response = $serializer->serialize($response, 'json');
            return new JsonResponse($response);
        }

        return $this->renderView('tenders/create.html.twig',[
            'form'   => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/tenders/editAsync", name="tenders_doEdit")
     */
    public function doEditAction(Request $request){

        $tendersRepository = $this->getDoctrine()->getRepository("AppBundle:Tenders");
        $tender = $tendersRepository->find($request->request->get('id'));

        $tender->setRemarks($request->request->get('remarks'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($tender);
        $em->flush();

        $response['data'] = $tender->getId();
        $serializer = $this->get('serializer');
        $response = $serializer->serialize($response, 'json');
        return new JsonResponse($response);

    }

}

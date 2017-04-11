<?php

namespace ReportBundle\Controller;


use ReportBundle\Entity\Category;
use ReportBundle\Entity\Channel;
use ReportBundle\Entity\Site;
use SABundle\Entity\GrabData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ReportBundle\Entity\Report;
use Symfony\Component\HttpFoundation\Request;

/**
 * Report controller.
 *
 * @Route("/admin/report/report")
 */
class ReportController extends Controller
{
    /**
     * Lists all Report entities.
     *
     * @Route("/page/{page}", name="admin_report_report_index"
     * , defaults={"page" = 1})
     * @Method("GET")
     */
    public function indexAction(Request $request, $page)
    {
        $criteria = ["page"=>$page];
        $conditionForm = $this->createConditionForm();
        $conditionForm->handleRequest($request);
        if($conditionForm->isSubmitted()&&$conditionForm->isValid()){
            $criteria["cnCategory"] = $request->get("form")["category"];
            $criteria["cnSite"] = $request->get("form")["site"];
        }
        $em = $this->getDoctrine()->getManager();

        $reports = $em->getRepository('ReportBundle:Report')
            ->findByPage($this->get('knp_paginator'),$criteria);

        return $this->render('ReportBundle:Report:index.html.twig', array(
            'reports' => $reports,
            'active'  => 'report_report',
            'condition_form' => $conditionForm->createView(),
        ));
    }

    private function createConditionForm(){
        return $this->createFormBuilder()
            ->setMethod("GET")
            ->setAction($this->generateUrl("admin_report_report_index"))
            ->add('category', EntityType::class,[
                'class' => Category::class ,
                'required' => false,
                'placeholder' => '选择栏目',
                'attr' => ['class'=>'form-control'],
            ])
            ->add('site', EntityType::class, [
                'class' => Site::class,
                'required' => false,
                'placeholder' => '选择站点',
                'attr' => ['class'=>'form-control'],
            ])
            ->getForm()
        ;
    }

    /**
     * Finds and displays a Report entity.
     *
     * @Route("/{id}", name="admin_report_report_show")
     * @Method("GET")
     */
    public function showAction(Report $report)
    {

        return $this->render('ReportBundle:Report:show.html.twig', array(
            'report' => $report,
            'active'  => 'report_report',
        ));
    }

    /**
     * @param Request $request
     * @Route("/generate", name="admin_report_report_generate")
     * @Method("POST")
     */
    public function generateAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $lastReport = $em->getRepository(Report::class)
            ->findBy([],["id"=>"DESC"],1);

        $grabData = $em->getRepository(GrabData::class)
            ->findReportData(isset($lastReport[0]) ? $lastReport[0] : null);

        foreach ($grabData as $item){
            $report = new Report();
            $report->setChannel(
                $em->getRepository(Channel::class)->find($item->getGrabRule()->getEntityId())
            );
            $data = \GuzzleHttp\json_decode($item->getData(), true);
            $report->setTitle($data["title"]);
            $report->setContent($data[0]["content"]);
            $report->setLink($data["page-link"]);
            $report->setGetAt($item->getCreateDate());
            $em->persist($report);

        }
        $em->flush();

        $this->addFlash(
            'notice',
            '生成报告成功!'
        );
        return $this->redirectToRoute('admin_report_report_index');
    }
}

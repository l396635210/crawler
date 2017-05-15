<?php

namespace ReportBundle\Controller;


use Doctrine\ORM\EntityRepository;
use ReportBundle\Entity\Category;
use ReportBundle\Entity\Channel;
use ReportBundle\Entity\Site;
use SABundle\Entity\GrabData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ReportBundle\Entity\Report;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
            $criteria["rPostStart"] = (new \DateTime($request->get("form")["postStart"]))->format("Y-m-d");
            $criteria["rPostEnd"] = (new \DateTime($request->get("form")["postEnd"]))->format("Y-m-d");
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
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('o')
                        ->where('o.canGrab = :canGrab')->setParameter('canGrab', true);
                },
                'required' => false,
                'placeholder' => '选择站点',
                'attr' => ['class'=>'form-control'],
            ])
            ->add('postStart', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'attr' => ['class' => 'js-datepicker form-control'],
            ])
            ->add('postEnd', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'attr' => ['class' => 'js-datepicker form-control'],
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
        $deleteForm = $this->createDeleteForm($report);
        return $this->render('ReportBundle:Report:show.html.twig', array(
            'report' => $report,
            'active'  => 'report_report',
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Category entity.
     *
     * @Route("/{id}", name="admin_report_report_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Report $report)
    {
        $form = $this->createDeleteForm($report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($report);
            $em->flush();
        }

        return $this->redirectToRoute('admin_report_report_index');
    }

    /**
     * Creates a form to delete a Category entity.
     *
     * @param Category $category The Category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Report $report)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_report_report_delete', array('id' => $report->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @param Request $request
     * @Route("/generate", name="admin_report_report_generate")
     * @Method("POST")
     */
    public function generateAction(Request $request){
        ini_set('memory_limit','1G');
        ignore_user_abort(1);
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
            $exist = $em->getRepository(Report::class)
                ->findOneBy(["title"=>$data["title"]]);
            if(!$exist){
                $report->setTitle($data["title"]);
                $report->setContent($data[0]["content"]);
                $report->setLink($data["page-link"]);
                $report->setGetAt($item->getCreateDate());
                if(isset($data[0]['datetime'])&&$data[0]['datetime']){
                    $report->setPostAt($report->filterPostAt($data[0]['datetime']));
                }
                $em->persist($report);
                $em->flush();
            }
        }

        $this->addFlash(
            'notice',
            '生成报告成功!'
        );
        return $this->redirectToRoute('admin_report_report_index');
    }
}

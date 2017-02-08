<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Area;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\AreaRepository;
use AppBundle\Form\AreaType;
use Symfony\Component\Security\Core\Role\Role;

class AreaController extends Controller
{
    /**
     * @Route("/admin/area/list", name="area_list")
     */
    public function listAction(Request $request)
    {
        $areaRepository = $this->getDoctrine()->getRepository("AppBundle:Area");
        $list = $areaRepository->findAll();

        // replace this example code with whatever you need
        return $this->render('area/list.html.twig', array(
            'active' => "app_area",
            'list' => $list,
        ));
    }

    /**
     * @Route("/admin/area/create", name="area_create")
     */
    public function createAction(Request $request)
    {
        $area = new Area();
        $form = $this->createForm(AreaType::class, $area);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $area = $form->getData();
            $area->setStatus(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();

            $this->addFlash(
                'notice',
                '添加'.$area->getAreaName().'成功!'
            );

            return $this->redirectToRoute('area_list');
        }
        // replace this example code with whatever you need
        return $this->render('area/create.html.twig', array(
            'active' => "app_area",
            'form'   => $form->createView(),
            'action' => 'Add',
            'title'  => '创建地址',
        ));
    }

    /**
     * @Route("/admin/area/edit/{id}", name="area_edit")
     */
    public function editAction(Request $request, $id)
    {
        $areaRepository = $this->getDoctrine()->getRepository('AppBundle:Area');
        $area = $areaRepository->find($id);
        $form = $this->createForm(AreaType::class, $area);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $area = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash(
                'notice',
                '修改'.$area->getAreaName().'成功!'
            );

            return $this->redirectToRoute('area_list');
        }
        // replace this example code with whatever you need
        return $this->render('area/create.html.twig', array(
            'active' =>  "app_area",
            'action' => 'Edit',
            'form'   => $form->createView(),
            'title'  => '修改地址',
        ));
    }

}

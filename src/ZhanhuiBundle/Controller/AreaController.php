<?php

namespace ZhanhuiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ZhanhuiBundle\Entity\Area;
use ZhanhuiBundle\Form\AreaType;

/**
 * Area controller.
 *
 * @Route("/admin/zh/area")
 */
class AreaController extends Controller
{
    /**
     * Lists all Area entities.
     *
     * @Route("/", name="admin_zh_area_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $areas = $em->getRepository('ZhanhuiBundle:Area')->findAll();

        return $this->render('ZhanhuiBundle:Area:index.html.twig', array(
            'areas' => $areas,
            'active'   => 'zh_area',
        ));
    }

    /**
     * Creates a new Area entity.
     *
     * @Route("/new", name="admin_zh_area_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $area = new Area();
        $form = $this->createForm(new AreaType(), $area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('admin_zh_area_show', array('id' => $area->getId()));
        }

        return $this->render('ZhanhuiBundle:Area:new.html.twig', array(
            'area' => $area,
            'form' => $form->createView(),
            'active'   => 'zh_area',
        ));
    }

    /**
     * Finds and displays a Area entity.
     *
     * @Route("/{id}", name="admin_zh_area_show")
     * @Method("GET")
     */
    public function showAction(Area $area)
    {
        $deleteForm = $this->createDeleteForm($area);

        return $this->render('ZhanhuiBundle:Area:show.html.twig', array(
            'area' => $area,
            'delete_form' => $deleteForm->createView(),
            'active'   => 'zh_area',
        ));
    }

    /**
     * Displays a form to edit an existing Area entity.
     *
     * @Route("/{id}/edit", name="admin_zh_area_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Area $area)
    {
        $deleteForm = $this->createDeleteForm($area);
        $editForm = $this->createForm(new AreaType(), $area);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('admin_zh_area_edit', array('id' => $area->getId()));
        }

        return $this->render('ZhanhuiBundle:Area:edit.html.twig', array(
            'area' => $area,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active'   => 'zh_area',
        ));
    }

    /**
     * Deletes a Area entity.
     *
     * @Route("/{id}", name="admin_zh_area_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Area $area)
    {
        $form = $this->createDeleteForm($area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($area);
            $em->flush();
        }

        return $this->redirectToRoute('admin_zh_area_index');
    }

    /**
     * Creates a form to delete a Area entity.
     *
     * @param Area $area The Area entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Area $area)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_zh_area_delete', array('id' => $area->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

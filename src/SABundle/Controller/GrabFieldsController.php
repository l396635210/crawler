<?php

namespace SABundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SABundle\Entity\GrabFields;
use SABundle\Form\GrabFieldsType;

/**
 * GrabFields controller.
 *
 * @Route("/admin/grabfields")
 */
class GrabFieldsController extends Controller
{
    /**
     * Lists all GrabFields entities.
     *
     * @Route("/", name="sa-grab_fields_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $grabFields = $em->getRepository('SABundle:GrabFields')->findAll();

        return $this->render('SABundle:GrabFields:index.html.twig', array(
            'grabFields' => $grabFields,
            'active'     => 'sa-grab_fields',
        ));
    }

    /**
     * Creates a new GrabFields entity.
     *
     * @Route("/new", name="grabfields_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $grabFields = new GrabFields();
        $form = $this->createForm(GrabFieldsType::class, $grabFields);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grabFields);
            $em->flush();

            return $this->redirectToRoute('grabfields_show', array('id' => $grabFields->getId()));
        }

        return $this->render('SABundle:GrabFields:new.html.twig', array(
            'grabField' => $grabFields,
            'form' => $form->createView(),
            'active'     => 'sa-grab_fields',
        ));
    }

    /**
     * Finds and displays a GrabFields entity.
     *
     * @Route("/{id}", name="grabfields_show")
     * @Method("GET")
     */
    public function showAction(GrabFields $grabField)
    {
        $deleteForm = $this->createDeleteForm($grabField);

        return $this->render('SABundle:GrabFields:show.html.twig', array(
            'grabField' => $grabField,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GrabFields entity.
     *
     * @Route("/{id}/edit", name="grabfields_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GrabFields $grabField)
    {
        $deleteForm = $this->createDeleteForm($grabField);
        $editForm = $this->createForm(new GrabFieldsType(), $grabField);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grabField);
            $em->flush();

            return $this->redirectToRoute('grabfields_edit', array('id' => $grabField->getId()));
        }

        return $this->render('SABundle:GrabFields:edit.html.twig', array(
            'grabField' => $grabField,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a GrabFields entity.
     *
     * @Route("/{id}", name="grabfields_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GrabFields $grabField)
    {
        $form = $this->createDeleteForm($grabField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($grabField);
            $em->flush();
        }

        return $this->redirectToRoute('grabfields_index');
    }

    /**
     * Creates a form to delete a GrabFields entity.
     *
     * @param GrabFields $grabField The GrabFields entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GrabFields $grabField)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('grabfields_delete', array('id' => $grabField->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace ReportBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ReportBundle\Entity\Site;
use ReportBundle\Form\SiteType;

/**
 * Site controller.
 *
 * @Route("/admin/report/site")
 */
class SiteController extends Controller
{
    /**
     * Lists all Site entities.
     *
     * @Route("/", name="admin_report_site_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sites = $em->getRepository('ReportBundle:Site')->findBy([
            "canGrab" => true,
        ]);

        return $this->render('ReportBundle:Site:index.html.twig', array(
            'sites' => $sites,
            'active' => 'report_site',
        ));
    }

    /**
     * Creates a new Site entity.
     *
     * @Route("/new", name="admin_report_site_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $site = new Site();
        $form = $this->createForm(new SiteType(), $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($site);
            $em->flush();

            return $this->redirectToRoute('admin_report_site_show', array('id' => $site->getId()));
        }

        return $this->render('ReportBundle:Site:new.html.twig', array(
            'site' => $site,
            'form' => $form->createView(),
            'active' => 'report_site',
        ));
    }

    /**
     * Finds and displays a Site entity.
     *
     * @Route("/{id}", name="admin_report_site_show")
     * @Method("GET")
     */
    public function showAction(Site $site)
    {
        $deleteForm = $this->createDeleteForm($site);

        return $this->render('ReportBundle:Site:show.html.twig', array(
            'site' => $site,
            'delete_form' => $deleteForm->createView(),
            'active' => 'report_site',
        ));
    }

    /**
     * Displays a form to edit an existing Site entity.
     *
     * @Route("/{id}/edit", name="admin_report_site_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Site $site)
    {
        $deleteForm = $this->createDeleteForm($site);
        $editForm = $this->createForm(new SiteType(), $site);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($site);
            $em->flush();

            return $this->redirectToRoute('admin_report_site_edit', array('id' => $site->getId()));
        }

        return $this->render('ReportBundle:Site:edit.html.twig', array(
            'site' => $site,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active' => 'report_site',
        ));
    }

    /**
     * Deletes a Site entity.
     *
     * @Route("/{id}", name="admin_report_site_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Site $site)
    {
        $form = $this->createDeleteForm($site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($site);
            $em->flush();
        }

        return $this->redirectToRoute('admin_report_site_index');
    }

    /**
     * Creates a form to delete a Site entity.
     *
     * @param Site $site The Site entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Site $site)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_report_site_delete', array('id' => $site->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

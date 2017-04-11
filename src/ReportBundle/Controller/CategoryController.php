<?php

namespace ReportBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ReportBundle\Entity\Category;
use ReportBundle\Form\CategoryType;

/**
 * Category controller.
 *
 * @Route("/admin/report/category")
 */
class CategoryController extends Controller
{
    /**
     * Lists all Category entities.
     *
     * @Route("/", name="admin_report_category_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('ReportBundle:Category')->findAll();

        return $this->render('ReportBundle:Category:index.html.twig', array(
            'categories' => $categories,
            'active' => 'report_category',
        ));
    }

    /**
     * Creates a new Category entity.
     *
     * @Route("/new", name="admin_report_category_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_report_category_show', array('id' => $category->getId()));
        }

        return $this->render('ReportBundle:Category:new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
            'active' => 'report_category',
        ));
    }

    /**
     * Finds and displays a Category entity.
     *
     * @Route("/{id}", name="admin_report_category_show")
     * @Method("GET")
     */
    public function showAction(Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);

        return $this->render('ReportBundle:Category:show.html.twig', array(
            'category' => $category,
            'delete_form' => $deleteForm->createView(),
            'active' => 'report_category',
        ));
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     * @Route("/{id}/edit", name="admin_report_category_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm(new CategoryType(), $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_report_category_edit', array('id' => $category->getId()));
        }

        return $this->render('ReportBundle:Category:edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active' => 'report_category',
        ));
    }

    /**
     * Deletes a Category entity.
     *
     * @Route("/{id}", name="admin_report_category_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Category $category)
    {
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('admin_report_category_index');
    }

    /**
     * Creates a form to delete a Category entity.
     *
     * @param Category $category The Category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_report_category_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

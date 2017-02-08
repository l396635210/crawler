<?php

namespace QABundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use QABundle\Entity\Tag;
use QABundle\Form\TagType;

/**
 * Tag controller.
 *
 * @Route("/admin/qa/tag")
 */
class TagController extends Controller
{
    /**
     * Lists all Tag entities.
     *
     * @Route("/", name="qa_tag_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('QABundle:Tag')->findAll();

        return $this->render('QABundle:Tag:index.html.twig', array(
            'tags' => $tags,
            'active' => 'qa_tag',
        ));
    }

    /**
     * Creates a new Tag entity.
     *
     * @Route("/new", name="qa_tag_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm(new TagType(), $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('qa_tag_show', array('id' => $tag->getId()));
        }

        return $this->render('QABundle:Tag:new.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
            'active' => 'qa_tag',
        ));
    }

    /**
     * Finds and displays a Tag entity.
     *
     * @Route("/{id}", name="qa_tag_show")
     * @Method("GET")
     */
    public function showAction(Tag $tag)
    {
        $deleteForm = $this->createDeleteForm($tag);

        return $this->render('QABundle:Tag:show.html.twig', array(
            'tag' => $tag,
            'delete_form' => $deleteForm->createView(),
            'active' => 'qa_tag',
        ));
    }

    /**
     * Displays a form to edit an existing Tag entity.
     *
     * @Route("/{id}/edit", name="qa_tag_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tag $tag)
    {
        $deleteForm = $this->createDeleteForm($tag);
        $editForm = $this->createForm(new TagType(), $tag);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('qa_tag_edit', array('id' => $tag->getId()));
        }

        return $this->render('QABundle:Tag:edit.html.twig', array(
            'tag' => $tag,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active' => 'qa_tag',
        ));
    }

    /**
     * Deletes a Tag entity.
     *
     * @Route("/{id}", name="qa_tag_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tag $tag)
    {
        $form = $this->createDeleteForm($tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tag);
            $em->flush();
        }

        return $this->redirectToRoute('qa_tag_index');
    }

    /**
     * Creates a form to delete a Tag entity.
     *
     * @param Tag $tag The Tag entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tag $tag)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('qa_tag_delete', array('id' => $tag->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

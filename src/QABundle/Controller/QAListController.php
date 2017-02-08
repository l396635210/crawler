<?php

namespace QABundle\Controller;

use AppBundle\Entity\CommonCode;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use QABundle\Entity\QAList;
use QABundle\Form\QAListType;

/**
 * QAList controller.
 *
 * @Route("/admin/qa/qalist")
 */
class QAListController extends Controller
{
    /**
     * Lists all QAList entities.
     *
     * @Route("/", name="qa_qalist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $qALists = $em->getRepository(QAList::class)->findAll();

        return $this->render('QABundle:Qalist:index.html.twig', array(
            'qALists' => $qALists,
            'active'  => 'qa_qalist',
        ));
    }

    /**
     * Creates a new QAList entity.
     *
     * @Route("/new", name="qa_qalist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $qAList = new QAList();
        $form = $this->createForm(QAListType::class, $qAList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $qAList->setName($qAList->getSite()->getName()."-".$qAList->getTag()->getName());
            $em = $this->getDoctrine()->getManager();
            $em->persist($qAList);
            $em->flush();
            return $this->redirectToRoute('qa_qalist_index');
        }

        return $this->render('QABundle:Qalist:new.html.twig', array(
            'qAList' => $qAList,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a QAList entity.
     *
     * @Route("/{id}", name="qa_qalist_show")
     * @Method("GET")
     */
    public function showAction(QAList $qAList)
    {
        $deleteForm = $this->createDeleteForm($qAList);

        return $this->render('QABundle:Qalist:show.html.twig', array(
            'qAList' => $qAList,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing QAList entity.
     *
     * @Route("/{id}/edit", name="qa_qalist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, QAList $qAList)
    {
        $deleteForm = $this->createDeleteForm($qAList);
        $editForm = $this->createForm(new QAListType(), $qAList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($qAList);
            $em->flush();

            return $this->redirectToRoute('qa_qalist_edit', array('id' => $qAList->getId()));
        }

        return $this->render('QABundle:Qalist:edit.html.twig', array(
            'qAList' => $qAList,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a QAList entity.
     *
     * @Route("/{id}", name="qa_qalist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, QAList $qAList)
    {
        $form = $this->createDeleteForm($qAList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($qAList);
            $em->flush();
        }

        return $this->redirectToRoute('qa_qalist_index');
    }

    /**
     * Creates a form to delete a QAList entity.
     *
     * @param QAList $qAList The QAList entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(QAList $qAList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('qa_qalist_delete', array('id' => $qAList->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/set/grab-rule/{id}",
     *      name="qa_set_grab_rule",
     *      requirements={"id":"\d+"}
     * )
     */
    public function setGrabRuleAction(Request $request){
        $criteria = [
            "entity" => CommonCode::QABundle_QAList,
            "entityId" => $request->get("id"),
        ];
        $em = $this->getDoctrine()->getManager();
        $grabRule = $em->getRepository("SABundle:GrabRule")->findOneBy($criteria);
        $criteria["back"] = "qa_qalist_index";

        if($grabRule){
            $response = $this->forward("SABundle:GrabRule:edit",["grabRule"=>$grabRule],$criteria);
        }else{
            $response = $this->forward("SABundle:GrabRule:new",[],$criteria);
        }

        return $response;
    }

}

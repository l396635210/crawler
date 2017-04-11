<?php

namespace ReportBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ReportBundle\Entity\Channel;
use ReportBundle\Form\ChannelType;

/**
 * Channel controller.
 *
 * @Route("/admin/report/channel")
 */
class ChannelController extends Controller
{
    /**
     * Lists all Channel entities.
     *
     * @Route("/", name="admin_report_channel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $channels = $em->getRepository('ReportBundle:Channel')->findAll();

        return $this->render('ReportBundle:Channel:index.html.twig', array(
            'channels' => $channels,
            'active' => 'report_channel',
        ));
    }

    /**
     * Creates a new Channel entity.
     *
     * @Route("/new", name="admin_report_channel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $channel = new Channel();
        $form = $this->createForm(new ChannelType(), $channel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $channel->setName($channel->getSite()."-".$channel->getCategory());
            $em->persist($channel);
            $em->flush();

            return $this->redirectToRoute('admin_report_channel_show', array('id' => $channel->getId()));
        }

        return $this->render('ReportBundle:Channel:new.html.twig', array(
            'channel' => $channel,
            'form' => $form->createView(),
            'active' => 'report_channel',
        ));
    }

    /**
     * Finds and displays a Channel entity.
     *
     * @Route("/{id}", name="admin_report_channel_show")
     * @Method("GET")
     */
    public function showAction(Channel $channel)
    {
        $deleteForm = $this->createDeleteForm($channel);

        return $this->render('ReportBundle:Channel:show.html.twig', array(
            'channel' => $channel,
            'delete_form' => $deleteForm->createView(),
            'active' => 'report_channel',
        ));
    }

    /**
     * Displays a form to edit an existing Channel entity.
     *
     * @Route("/{id}/edit", name="admin_report_channel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Channel $channel)
    {
        $deleteForm = $this->createDeleteForm($channel);
        $editForm = $this->createForm(new ChannelType(), $channel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($channel);
            $em->flush();

            return $this->redirectToRoute('admin_report_channel_edit', array('id' => $channel->getId()));
        }

        return $this->render('ReportBundle:Channel:edit.html.twig', array(
            'channel' => $channel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active' => 'report_channel',
        ));
    }

    /**
     * Deletes a Channel entity.
     *
     * @Route("/{id}", name="admin_report_channel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Channel $channel)
    {
        $form = $this->createDeleteForm($channel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($channel);
            $em->flush();
        }

        return $this->redirectToRoute('admin_report_channel_index');
    }

    /**
     * Creates a form to delete a Channel entity.
     *
     * @param Channel $channel The Channel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Channel $channel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_report_channel_delete', array('id' => $channel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/set/grab-rule/{id}",
     *      name="report_set_grab_rule",
     *      requirements={"id":"\d+"}
     * )
     */
    public function setGrabRuleAction(Request $request){
        $criteria = [
            "entity" => Channel::LOGIC_NAME,
            "entityId" => $request->get("id"),
        ];
        $em = $this->getDoctrine()->getManager();
        $grabRule = $em->getRepository("SABundle:GrabRule")->findOneBy($criteria);
        $criteria["back"] = "admin_report_channel_index";

        if($grabRule){
            $response = $this->forward("SABundle:GrabRule:edit",["grabRule"=>$grabRule],$criteria);
        }else{
            $response = $this->forward("SABundle:GrabRule:new",[],$criteria);
        }

        return $response;
    }
}

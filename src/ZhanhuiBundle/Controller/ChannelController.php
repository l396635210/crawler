<?php

namespace ZhanhuiBundle\Controller;

use AppBundle\Entity\CommonCode;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ZhanhuiBundle\Entity\Channel;
use ZhanhuiBundle\Form\ChannelType;

/**
 * Channel controller.
 *
 * @Route("/admin/zh/channel")
 */
class ChannelController extends Controller
{
    /**
     * Lists all Channel entities.
     *
     * @Route("/", name="admin_zh_channel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $channels = $em->getRepository('ZhanhuiBundle:Channel')
            ->findBy(["status"=>true],["id"=>"DESC"]);

        return $this->render('ZhanhuiBundle:Channel:index.html.twig', array(
            'channels' => $channels,
            'active'   => 'zh_channel',
        ));
    }

    /**
     * Creates a new Channel entity.
     *
     * @Route("/new", name="admin_zh_channel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $channel = new Channel();
        $form = $this->createForm(new ChannelType(), $channel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($channel);
            $em->flush();

            return $this->redirectToRoute('admin_zh_channel_show', array('id' => $channel->getId()));
        }

        return $this->render('ZhanhuiBundle:Channel:new.html.twig', array(
            'channel' => $channel,
            'form' => $form->createView(),
            'active'   => 'zh_channel',
        ));
    }

    /**
     * Finds and displays a Channel entity.
     *
     * @Route("/{id}", name="admin_zh_channel_show")
     * @Method("GET")
     */
    public function showAction(Channel $channel)
    {
        $deleteForm = $this->createDeleteForm($channel);

        return $this->render('ZhanhuiBundle:Channel:show.html.twig', array(
            'channel' => $channel,
            'delete_form' => $deleteForm->createView(),
            'active'   => 'zh_channel',
        ));
    }

    /**
     * Displays a form to edit an existing Channel entity.
     *
     * @Route("/{id}/edit", name="admin_zh_channel_edit")
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

            return $this->redirectToRoute('admin_zh_channel_edit', array('id' => $channel->getId()));
        }

        return $this->render('ZhanhuiBundle:Channel:edit.html.twig', array(
            'channel' => $channel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active'   => 'zh_channel',
        ));
    }

    /**
     * Deletes a Channel entity.
     *
     * @Route("/{id}", name="admin_zh_channel_delete")
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

        return $this->redirectToRoute('admin_zh_channel_index');
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
            ->setAction($this->generateUrl('admin_zh_channel_delete', array('id' => $channel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/set/grab-rule/{id}",
     *      name="zh_channel_set_grab_rule",
     *      requirements={"id":"\d+"}
     * )
     */
    public function setGrabRuleAction(Request $request){
        $criteria = [
            "entity" => CommonCode::ZhanhuiBundle_Channel,
            "entityId" => $request->get("id"),
        ];
        $em = $this->getDoctrine()->getManager();
        $grabRule = $em->getRepository("SABundle:GrabRule")->findOneBy($criteria);
        $criteria["back"] = "admin_zh_channel_index";

        if($grabRule){
            $response = $this->forward("SABundle:GrabRule:edit",["grabRule"=>$grabRule],$criteria);
        }else{
            $response = $this->forward("SABundle:GrabRule:new",[],$criteria);
        }

        return $response;
    }
}

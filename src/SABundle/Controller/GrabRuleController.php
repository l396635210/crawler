<?php

namespace SABundle\Controller;

use SABundle\Entity\GrabRule;
use SABundle\Form\GrabRuleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

/**
 * SAList controller.
 *
 * @Route("/admin/sa/grab-rule",service="sa.grab_rule")
 */
class GrabRuleController extends Controller
{

    /**
     * @param $name
     * @return Response
     * @Route("/",name="sa_grab-rule_index")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $grabRules = $em->getRepository(GrabRule::class)->findAll();
        return $this->render('SABundle:GrabRule:index.html.twig',[
            'grabRules' => $grabRules
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route(
     *     "/new/{entity}/{entityId}",
     *     name="sa_grab-rule_new",
     *     requirements={"entityId": "\d+", "entity":"[A-Z](\w+)Bundle:[A-Z](\w+)"}
     * )
     */
    public function newAction(Request $request){
        $grabRule = new GrabRule();
        $form = $this->createForm(GrabRuleType::class, $grabRule,[
            "request"=>$request,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $grabRule->setStatus(true);
            $em->persist($grabRule);
            $em->flush();
            $this->addFlash(
                'notice',
                '添加规则成功!'
            );
            return $this->redirectToRoute($request->get("back"), ['id' => $request->get("entityId")]);
        }
        return $this->render('SABundle:GrabRule:new.html.twig',[
            'form' => $form->createView(),
            'active'    => 'sa-grab_rule',
        ]);
    }

    /**
     * Finds and displays a GrabData entity.
     *
     * @Route("/{id}", name="sa_grab-rule_show")
     * @Method("GET")
     */
    public function showAction(GrabRule $grabRule)
    {
        $deleteForm = $this->createDeleteForm($grabRule);

        return $this->render('SABundle:GrabRule:show.html.twig', array(
            'grabRule' => $grabRule,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing GrabData entity.
     *
     * @Route("/{id}/edit", name="sa_grab-rule_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GrabRule $grabRule)
    {
        $deleteForm = $this->createDeleteForm($grabRule);
        $editForm = $this->createForm(GrabRuleType::class, $grabRule, [
            "request" => $request,
        ]);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($grabRule);
            $em->flush();
            $this->addFlash(
                'notice',
                '设置规则成功!'
            );
            return $this->redirectToRoute($request->get("back"), ['id' => $request->get("entityId")]);
        }

        return $this->render('SABundle:GrabRule:edit.html.twig', array(
            'grabRule' => $grabRule,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'back'          => $request->get("back"),
            'active'    => 'sa-grab_rule',
        ));
    }

    /**
     * Deletes a GrabData entity.
     *
     * @Route("/{id}", name="admin_sa_grab-rule_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GrabRule $grabRule)
    {
        $form = $this->createDeleteForm($grabRule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $grabRule->setStatus(false);
            $em->persist($grabRule);
            $em->flush();
        }

        return $this->redirectToRoute('admin_grab_rule_index');
    }

    /**
     * Creates a form to delete a GrabData entity.
     *
     * @param GrabRule $grabDatum The GrabData entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GrabRule $grabDatum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sa_grab-data_delete', array('id' => $grabDatum->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * @Route("/status", name="sa_grab-rule_status")
     */
    public function setStatusAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $grabRule = $em->getRepository(GrabRule::class)
            ->findOneBy([
               "entity" => GrabRule::getRequestMapping($request->get("entity")),
               "entityId" => $request->get("entityId")
            ]);
        $grabRule->setStatus($request->get("status"));
        $em->persist($grabRule);
        $em->flush();
    }
}

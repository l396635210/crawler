<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Country;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CountryType;

use Symfony\Component\Serializer\Serializer;

class CountryController extends Controller
{
    /**
     * @Route("/admin/country/list", name="country_list")
     */
    public function listAction(Request $request)
    {
        $areaRepository = $this->getDoctrine()->getRepository('AppBundle:Area');
        $areaList = $areaRepository->findAll();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Country');
        $list = $repository->findAll();
        // replace this example code with whatever you need
        return $this->render('country/list.html.twig', array(
            'active'    => $request->get('_route'),
            'list'      => $list,
            'areaList'  => $areaList,
        ));
    }

    /**
     * @Route("/admin/country/listAjax", name="country_listAjax")
     */
    public function listAjaxAction(Request $request)
    {
        $areaId = $request->request->get('areaId');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Country');
        $list = $repository->findBy(array('areaId'=>$areaId));

        $res = [];
        foreach ($list as $k=>$item){
            $res[$k]["id"] = $item->getId();
            $res[$k]["countryName"] = $item->getCountryName();
        }

        return new JsonResponse(["data"=>$res]);
    }

    /**
     * @Route("/admin/country/create", name="country_create")
     */
    public function createAction(Request $request)
    {
        $country = new Country();
        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $country = $form->getData();
            $country->setStatus(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            $this->addFlash(
                'notice',
                '添加'.$country->getCountryName().'成功!'
            );

            return $this->redirectToRoute('country_list');
        }
        // replace this example code with whatever you need
        return $this->render('country/create.html.twig', array(
            'active' => $request->get('_route'),
            'action' => 'Create',
            'form'   => $form->createView(),
            'title'  => '创建国家'
        ));
    }

    /**
     * @Route("/admin/country/edit{id}", name="country_edit")
     */
    public function editAction(Request $request, $id)
    {
        $countryRepository = $this->getDoctrine()->getRepository('AppBundle:Country');
        $country = $countryRepository->find($id);
        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $country = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            $this->addFlash(
                'notice',
                '修改'.$country->getCountryName().'成功!'
            );

            return $this->redirectToRoute('country_list');
        }
        // replace this example code with whatever you need
        return $this->render('country/create.html.twig', array(
            'active' => $request->get('_route'),
            'action' => 'Edit',
            'form'   => $form->createView(),
            'title'  => '修改国家',
        ));
    }
}

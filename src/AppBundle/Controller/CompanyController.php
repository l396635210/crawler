<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CommonCode;
use AppBundle\Entity\Company;
use AppBundle\Entity\Country;
use AppBundle\Entity\Sites;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CompanyType;
use Symfony\Component\Validator\Constraints\Date;

class CompanyController extends Controller
{
    /**
     * @Route("/admin/company/list", name="company_list")
     */
    public function listAction(Request $request)
    {
        $areaRepository = $this->getDoctrine()->getRepository('AppBundle:Area');
        $areaList = $areaRepository->findAll();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Company');
        $list = $repository->findByUser($this->getUser());

        // replace this example code with whatever you need
        return $this->render('company/list.html.twig', array(
            'active'    => $request->get('_route'),
            'list'      => $list,
            'areaList'  => $areaList,
        ));
    }

    /**
     * @Route("/admin/company/create", name="company_create")
     */
    public function createAction(Request $request)
    {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){

            $em = $this->getDoctrine()->getManager();
            $company = $form->getData();
            $company->setCreateDate(new \DateTime("now"));
            $company->setCreateTime(new \DateTime("now"));
            $company->setSort();
            $company->setUpdateDate(new \DateTime("now"));
            $company->setUpdateTime(new \DateTime("now"));
            $company->setUpdateUser($this->getUser());
            $em->persist($company);
            //$this->setSites($company, $em);

            $em->flush();
            $this->addFlash(
                'notice',
                '添加'.$company->getCompanyName().'成功!'
            );
            $request->request->set("company", $company);
            $this->forward('CompaniesBundle:Tcompany:pushTest');
            return $this->redirectToRoute('company_list');
        }
        // replace this example code with whatever you need
        return $this->render('company/create.html.twig', array(
            'active' => $request->get('_route'),
            'action' => 'Create',
            'form'   => $form->createView(),
            'title'  => '创建渠道',
        ));
    }

    /**
     * @Route("/admin/company/edit/{id}", name="company_edit")
     */
    public function editAction(Request $request, $id)
    {

        $companyRepository = $this->getDoctrine()->getRepository('AppBundle:Company');
        $company = $companyRepository->find($id);
        $form = $this->createForm(CompanyType::class, $company);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){

            $em = $this->getDoctrine()->getManager();
            $company = $form->getData();
            $company->setSort();
            $company->setUpdateDate(new \DateTime("now"));
            $company->setUpdateTime(new \DateTime("now"));
            $company->setUpdateUser($this->getUser());
            $em->persist($company);
            //$this->setSites($company, $em);
            $em->flush();

            $this->addFlash(
                'notice',
                '修改'.$company->getCompanyName().'成功!'
            );
            $request->request->set("company", $company);

            $this->forward('CompaniesBundle:Tcompany:pushTest');

            return $this->redirectToRoute('company_list',['id'=>$company->getId()]);
        }

        // replace this example code with whatever you need
        return $this->render('company/create.html.twig', array(
            'active' => $request->get('_route'),
            'action' => 'Edit',
            'form'   => $form->createView(),
            'title'  => '修改渠道',
        ));
    }

    /**
     * @Route("/admin/company/editAsync", name="company_editAsync")
     */
    public function editAsyncAction(Request $request){

        $companyRepository = $this->getDoctrine()->getRepository('AppBundle:Company');
        $company = $companyRepository->find($request->request->get('id'));
        if($request->request->get('remarks')){
            $company->setRemarks($request->request->get('remarks'));
        }
        $company->setSort();
        if($request->request->get('isPush')){
            $company->setIsPush($company->getIsPush() ? false : true);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($company);

        $em->flush();

        $response['data'] = true;
        $serializer = $this->get('serializer');
        $response = $serializer->serialize($response, 'json');
        return new JsonResponse($response);
    }

    /**
     * @Route("/admin/company/delete/{id}", name="company_delete")
     */
    public function deleteAction(Request $request, $id){

        $companyRepository = $this->getDoctrine()->getRepository('AppBundle:Company');
        $company = $companyRepository->find($id);
        $company->setStatus(0);
        $em = $this->getDoctrine()->getManager();
        $em->persist($company);

        $em->flush();

        return $this->redirectToRoute('company_list');
    }

    //添加site表 未使用
    protected function setSites(Company $company, $em){
        //$sitesRepository = $this->getDoctrine()->getRepository('AppBundle:Sites');
        foreach($company->getSitesArray() as $url){
            $sites = new Sites();
            $sites->setCompany($company);
            $sites->setSiteUrl($url);
            $em->persist($sites);
        }
    }

    /**
     * @Route("/admin/company/set/grab-rule/{id}",
     *      name="set_grab_rule",
     *      requirements={"id":"\d+"}
     * )
     */
    public function setGrabRuleAction(Request $request){
        $criteria = [
            "entity" => CommonCode::AppBundle_Company,
            "entityId" => $request->get("id"),
        ];
        $em = $this->getDoctrine()->getManager();
        $grabRule = $em->getRepository("SABundle:GrabRule")->findOneBy($criteria);
        $criteria["back"] = "company_list";

        if($grabRule){
            $response = $this->forward("SABundle:GrabRule:edit",["grabRule"=>$grabRule],$criteria);
        }else{
            $response = $this->forward("SABundle:GrabRule:new",[],$criteria);
        }

        return $response;
    }
}

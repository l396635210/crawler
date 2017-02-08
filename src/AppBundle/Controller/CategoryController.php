<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Area;
use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Role\Role;

class CategoryController extends Controller
{
    /**
     * @Route("/admin/category/list", name="category_list")
     */
    public function listAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository("AppBundle:Category");
        $list = $repository->findBy([
            "status" => 1
        ]);

        // replace this example code with whatever you need
        return $this->render('category/list.html.twig', array(
            'active' => $request->get('_route'),
            'list'   => $list,
            'title'  => '分类管理'
        ));
    }

    /**
     * @Route("/admin/category/create", name="category_create")
     */
    public function createAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $category = $form->getData();
            $category->setInsert($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'notice',
                '添加'.$category->getName().'成功!'
            );

            return $this->redirectToRoute('category_list');
        }
        // replace this example code with whatever you need
        return $this->render('category/create.html.twig', array(
            'active' => $request->get('_route'),
            'form'   => $form->createView(),
            'action' => 'Create',
            'title'  => '创建分类',
        ));
    }

    /**
     * @Route("/admin/category/edit/{id}", name="category_edit")
     */
    public function editAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Category');
        $category = $repository->find($id);
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $area = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash(
                'notice',
                '修改'.$area->getAreaName().'成功!'
            );

            return $this->redirectToRoute('area_list');
        }
        // replace this example code with whatever you need
        return $this->render('category/create.html.twig', array(
            'active' => $request->get('_route'),
            'action' => 'Edit',
            'form'   => $form->createView(),
            'title'  => '修改地址',
        ));
    }

}

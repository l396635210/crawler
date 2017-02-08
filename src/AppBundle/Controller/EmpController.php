<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Emp;
use AppBundle\Service\LogTool;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\EmpRepository;
use AppBundle\Form\EmpType;

class EmpController extends Controller
{
    /**
     * @Route("/admin/emp/list", name="emp_list")
     */
    public function listAction(Request $request)
    {
        $empRepository = $this->getDoctrine()->getRepository("AppBundle:Emp");
        $list = $empRepository->findBy([
            "status" => true
        ]);
        // replace this example code with whatever you need
        return $this->render('emp/list.html.twig', array(
            'active' => $request->get('_route'),
            'list' => $list,
        ));
    }

    /**
     * @Route("/admin/emp/create", name="emp_create")
     */
    public function createAction(Request $request)
    {
        $emp = new emp();
        $form = $this->createForm(EmpType::class, $emp);

        $companyRepository = $this->getDoctrine()->getRepository('AppBundle:Company');
        $companies = $companyRepository->findBy(array(),array('areaId'=>'DESC'));

        $siteRepository = $this->getDoctrine()->getRepository('AppBundle:Site');
        $sites = $siteRepository->findBy(array(),array('categoryId'=>'DESC'));

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $emp = $form->getData();
            $emp->setStatus(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($emp);
            $em->flush();

            $this->addFlash(
                'notice',
                '添加'.$emp->getEmpName().'成功!'
            );

            return $this->redirectToRoute('emp_list');
        }
        // replace this example code with whatever you need
        return $this->render('emp/create.html.twig', array(
            'active'    => $request->get('_route'),
            'action'    => 'Create',
            'form'      => $form->createView(),
            'companies' => $companies,
            'sites'    => $sites,
        ));
    }

    /**
     * @Route("/admin/emp/edit/{id}", name="emp_edit")
     */
    public function editAction(Request $request, $id)
    {
        $empRepository = $this->getDoctrine()->getRepository('AppBundle:Emp');
        $emp = $empRepository->find($id);
        $companyRepository = $this->getDoctrine()->getRepository('AppBundle:Company');
        $companies = $companyRepository->findBy(array(),array('areaId'=>'DESC'));

        $siteRepository = $this->getDoctrine()->getRepository('AppBundle:Site');
        $sites = $siteRepository->findBy(array(),array('categoryId'=>'DESC'));

        $form = $this->createForm(EmpType::class, $emp);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $emp = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash(
                'notice',
                '修改'.$emp->getEmpName().'成功!'
            );

            return $this->redirectToRoute('emp_list');
        }
        // replace this example code with whatever you need
        return $this->render('emp/create.html.twig', array(
            'active'    => $request->get('_route'),
            'action'    => 'Edit',
            'form'      => $form->createView(),
            'companies' => $companies,
            'sites'     => $sites,
        ));
    }

    /**
     * @Route("/admin/emp/send/information",name="send_information_emp")
     */
    public function sendInformationMailsForEmpAction(Request $request){
        $er = $this->getDoctrine()->getRepository("AppBundle:Emp");
        $list = $er->findBy([
            "isSendInformation" => true
        ]);
        $ifmtEr = $this->getDoctrine()->getRepository("AppBundle:Information");
        #$request->request->set('date','2016-12-25');
        foreach ( $list as $emp ){
            $emp->setSitesForSend($request);
            $sendIfmts = $ifmtEr->findByCondition($request,[
                "s.categoryId" => "ASC"
            ]);
            if($sendIfmts){
                $this->setMailBody($sendIfmts);
                $message = \Swift_Message::newInstance()
                    ->setSubject('今日资讯更新提醒')
                    ->setFrom($this->getParameter('mailer_user'))
                    ->setTo(array($emp->getEmpMail()=>$emp->getEmpName()))
                    #->setTo(["lizheng@fonchan.com"])
                    ->setBody($this->renderView(
                        'email/information.html.twig',[
                        "body" => $this->setMailBody($sendIfmts),
                        "name" => $emp->getEmpName()
                    ]), 'text/html');

                $logger = new LogTool('applog',$this->get('kernel')->getRootDir());
                $logger->addInfo("邮件发送给{...".$emp->getEmpName().":".$emp->getEmpMail()."...}");
                $this->get("mailer")->send($message);
            }
        }
        return $this->redirectToRoute('information_list');
    }

    protected function setMailBody($list){
        $category = "";
        $site = "";
        $i = 0;
        $body = "";
        foreach ( $list as $key=>$item){
            if($item->getSite()->getCategory()->getName()!=$category){
                $i = 0;
                $body .= '<h2 style="color: #636363;background:yellow;border-top: 1px solid #eee;" class="zh p">'.$item->getSite()->getCategory()->getName().'</h2>';
            }
            if($item->getSite()->getName()!=$site){
                if($i){
                    $body.= '<p><a href="'.$item->getSite()->getUrl().'">浏览'.$item->getSite()->getName().'，查看更多</a></p><hr>';
                }
                $i = 1;
                $body .= '<h3 style="color: red" class="zh p">'.$item->getSite()->getName().':</h3>';
            }else{
                $i += 1;
            }
            if($i<=5){
                $body .= '<p>'.$i.'.<a href="'.$item->getLocation().'">'.$item->getTitle().'</a></p>';
            }
            $category = $item->getSite()->getCategory()->getName();
            $site = $item->getSite()->getName();
        }
        return $body;
    }


}

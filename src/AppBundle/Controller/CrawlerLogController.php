<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Area;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\AreaRepository;
use AppBundle\Form\AreaType;
use Symfony\Component\Validator\Constraints\DateTime;

class CrawlerLogController extends Controller
{
    /**
     * @Route("/admin/crawler/log", name="crawler_log")
     */
    public function listAction(Request $request)
    {
        $companyRepository = $this->getDoctrine()->getRepository("AppBundle:Company");
        $companyList = $companyRepository->findAll();

        $crawlerLogRepository = $this->getDoctrine()->getRepository("AppBundle:CrawlerLog");

        $request->query->get('date') || $request->query->set('date', date('Y-m-d'));
        $list = $crawlerLogRepository->findByCompaniesDate($request, false);
        //$list = $crawlerLogRepository->findByCompaniesDate($request);
        #dump($list);
        // replace this example code with whatever you need
        return $this->render('crawler/log.html.twig', array(
            'active'        => $request->get('_route'),
            'list'          => $list,
            'companyList'   => $companyList,
            'date'          => $request->query->get('date'),
            'company'       => $request->query->get('company')
        ));
    }

}

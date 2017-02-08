<?php

namespace SABundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Filesystem\Filesystem;

class DefaultController extends Controller
{
    /**
     * @Route("/admin/sa/index")
     */
    public function indexAction()
    {
        return $this->render('SABundle:Default:index.html.twig');
    }

    /**
     * @Route("/super/cache/clear", name="sa_cache_clear")
     */
    public function cacheClearAction(){
        try{
            $fs = new Filesystem();

            $fs->remove($this->getParameter('kernel.cache_dir')."/../");
        }catch (\Exception $e){
            //$this->get("logger")->info($e->getMessage());
        }

        #$fs->remove("/mdata/crawler/app/cache");
        return $this->redirectToRoute('homepage');
    }
}

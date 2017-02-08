<?php

namespace ZhanhuiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/zhanhui", name="zhanhui_default")
     */
    public function indexAction()
    {
        return $this->render('ZhanhuiBundle:Default:index.html.twig');
    }
}

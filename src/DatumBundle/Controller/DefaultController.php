<?php

namespace DatumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/datum")
     */
    public function indexAction()
    {
        return $this->render('DatumBundle:Default:index.html.twig');
    }
}

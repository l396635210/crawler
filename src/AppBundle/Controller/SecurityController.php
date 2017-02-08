<?php

namespace AppBundle\Controller;

use AppBundle\Service\DomGrab;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\Mail;
use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;
use Symfony\Component\BrowserKit\Cookie;
use AppBundle\Service\CompanyService;
use AppBundle\Entity\CrawlerLog;
use Symfony\Component\HttpFoundation\JsonResponse;
class SecurityController extends Controller
{
    /**
     * @Route("/forbid", name="forbid")
     */
    public function forbidAction(Request $request)
    {

        return $this->render('exception/error500.html.twig');
    }

    /**
     * @Route("/notFound", name="notFound")
     */
    public function notFoundAction(Request $request)
    {
        return $this->render('exception/error404.html.twig');
    }

}

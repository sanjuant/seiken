<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/news")
 */
class NewsController extends Controller
{
    /**
     * @Route("/", name="news")
     */
    public function indexAction()
    {
        return $this->render('@App/News/news.html.twig', array(
            'img' => 'assets/img/news.jpg',
            'position' => 'center'
        ));
    }
}
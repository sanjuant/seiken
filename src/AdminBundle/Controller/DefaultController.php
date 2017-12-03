<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin")
 */
class DefaultController extends Controller
{
    public $module = "admin";

    /**
     * @Route("/", name="admin.index")
     */
    public function indexAction()
    {
        return $this->render('@Admin/Default/index.html.twig');
    }
}

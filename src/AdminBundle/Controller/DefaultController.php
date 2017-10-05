<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public $module = "admin";

    /**
     * @Route("/admin", name="admin.index")
     */
    public function indexAction()
    {
        return $this->render('@Admin/Default/index.html.twig');
    }
}

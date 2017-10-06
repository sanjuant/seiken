<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("")
 */
class ShopController extends Controller
{
    /**
     * @Route("", name="")
     */
    public function indexAction()
    {


        return $this->render('@App/Bout');
    }
}
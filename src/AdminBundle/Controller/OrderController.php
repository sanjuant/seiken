<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Order;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class OrderController extends Controller
{
    public $module = "order";

    /**
     * @Route("/orders", name="admin.orders")
     */
    public function indexAction()
    {
        // SELECT * FROM posts;
        $orders = $this
            ->getDoctrine()
            ->getRepository(Order::class)
            ->findAll()
        ;

        return $this->render('@Admin/Order/index.html.twig', array(
            'orders' => $orders
        ));
    }
}
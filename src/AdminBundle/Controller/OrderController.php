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

    /**
     * @Route("/order/payoff/{id}", name="admin.order.payoff")
     */
    public function payOffAction($id)
    {
        // SELECT * FROM posts;
        $order = $this->getDoctrine()->getRepository(Order::class)->find($id);

        $order->setPayOff($order->getPayOff() === true ? false : true);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin.orders');
    }

    /**
     * @Route("/order/{id}", name="admin.order.view")
     */
    public function viewAction(Order $order)
    {
        return $this->render('@Admin/Order/view.html.twig', array(
            'order' => $order
        ));
    }

    /**
     * @Route("/order/delete/{id}", name="admin.order.delete")
     */
    public function deleteAction(Order $order)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($order);
        $em->flush();

        return $this->redirectToRoute('admin.orders');
    }
}
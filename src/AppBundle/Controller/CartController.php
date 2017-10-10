<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Form\OrderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/cart")
 */
class CartController extends Controller
{
    /**
     * @Route("", name="cart")
     */
    public function cartAction()
    {
        $cart = $this->get('app.cart')->get();

        return $this->render('@App/Cart/index.html.twig', array(
            'img' => 'assets/img/boutique.jpg',
            'position' => 'center',
            'cart' => $cart
        ));
    }

    /**
     * @Route("/delete/{id}", name="cart.item.delete")
     */
    public function cartItemDeleteAction($id)
    {
        $this->get('app.cart')->remove($id);

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/address", name="cart.address")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addressAction(Request $request)
    {
        $order = new Order();
        $cart = $this->get('app.cart');
        $order->setCart(serialize($cart->get()));
        $order->setPayOff(false);
        $order->setTotalPrice($cart->totalPrice());


        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            $em->refresh($order);

            return $this->redirectToRoute('cart.recap', array('id' => $order->getId()));
        }

        return $this->render('@App/Cart/address.html.twig', array(
            'img' => 'assets/img/boutique.jpg',
            'position' => 'center',
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/recap/{id}", name="cart.recap")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function recapAction($id)
    {
        $recap = $this->getDoctrine()->getRepository(Order::class)->find($id);

        return $this->render('@App/Cart/recap.html.twig', array(
            'img' => 'assets/img/boutique.jpg',
            'position' => 'center',
            'recap' => $recap
        ));
    }

    /**
     * @Route("/success", name="cart.success")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function successAction()
    {
        return $this->render('@App/Cart/success.html.twig', array(
            'img' => 'assets/img/boutique.jpg',
            'position' => 'center',
        ));
    }

}

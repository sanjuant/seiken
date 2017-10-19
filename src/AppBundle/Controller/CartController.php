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
            'page' => 'cart',
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
        if ($this->get('session')->get('order') === null) {
            $order = new Order();
            $cart = $this->get('app.cart');
            $order->setCart(serialize($cart->get()));
            $order->setPayOff(0);
            $order->setTotalPrice($cart->totalPrice());
        } else {
            $order = $this->get('session')->get('order');
        }

        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session = $this->get('session');
            $session->set('order', $order);

            return $this->redirectToRoute('cart.recap');
        }

        return $this->render('@App/Cart/address.html.twig', array(
            'img' => 'assets/img/boutique.jpg',
            'position' => 'center',
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/recap", name="cart.recap")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function recapAction()
    {
        $recap = $this->get('session')->get('order');

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
        $em = $this->getDoctrine()->getManager();
        $em->persist($this->get('session')->get('order'));
        $em->flush();

        $this->get('session')->clear();

        return $this->render('@App/Cart/success.html.twig', array(
            'img' => 'assets/img/boutique.jpg',
            'position' => 'center',
        ));
    }

}

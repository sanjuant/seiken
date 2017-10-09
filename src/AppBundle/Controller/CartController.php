<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartController extends Controller
{
    /**
     * @Route("/cart", name="cart")
     */
    public function cartAction()
    {
        $cart = $this->get('app.cart')->get();

        return $this->render('@App/Shop/cart.html.twig', array(
            'img' => 'assets/img/boutique.jpg',
            'position' => 'center',
            'cart' => $cart
        ));
    }

    /**
     * @Route("/cart/delete/{id}", name="cart.item.delete")
     */
    public function cartItemDeleteAction($id)
    {
        $this->get('app.cart')->remove($id);

        return $this->redirectToRoute('cart');
    }
}

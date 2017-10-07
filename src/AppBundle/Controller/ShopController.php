<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\CartItemType;
use AppBundle\Shop\CartItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/boutique")
 */
class ShopController extends Controller
{
    /**
     * @Route("", name="boutique")
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('@App/Shop/index.html.twig', array(
            'img' => 'assets/img/boutique.jpg',
            'position' => 'center',
            'products' => $products
        ));
    }

    public function formAction(Product $product, Request $request)
    {
        $cartItem = new CartItem();
        $cartItem->setProduct($product);

        $form = $this->createForm(CartItemType::class, $cartItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('boutique');
        }

        return $this->render('@App/Shop/cart-item.html.twig', array(
            'cartItem' => $cartItem,
            'form' => $form->createView()
        ));

    }
}
<?php

namespace Tests\Appbundle\Shop;

use AppBundle\Shop\Cart;
use AppBundle\Shop\CartItem;
use AppBundle\Entity\Product;

use Symfony\Component\HttpFoundation\Session\Session;

class CartTest extends \PHPUnit_Framework_TestCase
{
    public function testItCanAddAnItem()
    {
        $cartItem = new CartItem();
        $cartItem->setSize('XL');
        $cartItem->setQuantity(1);
        $cartItem->setProduct(new Product());

        $cart = new Cart(new Session());
        $cart->add($cartItem);

        $this->assertCount(1, $cart->get());
        $this->assertEquals(0, $cart->searchItem($cartItem));
    }

    public function testItCanAddManyItem()
    {
        $cart = new Cart(new Session());

        $cartItem = new CartItem();
        $cartItem->setSize('XL');
        $cartItem->setQuantity(1);
        $cartItem->setProduct(new Product());

        $cart->add($cartItem);

        $cartItem = new CartItem();
        $cartItem->setSize('L');
        $cartItem->setQuantity(1);
        $cartItem->setProduct(new Product());

        $cart->add($cartItem);

        $this->assertEquals(1, $cart->searchItem($cartItem));
        $this->assertCount(2, $cart->get());
    }

    public function testItIncreasesQuantityIfItemHasAlreadyBeenAdded()
    {
        $quantity = 2;

        $cartItem = new CartItem();
        $cartItem->setSize('XL');
        $cartItem->setQuantity($quantity);
        $cartItem->setProduct(new Product());

        $cart = new Cart(new Session());
        $cart->add($cartItem);
        $cart->add($cartItem);

        $cartItem = new CartItem();
        $cartItem->setSize('L');
        $cartItem->setQuantity(90);
        $cartItem->setProduct(new Product());

        $cart->add($cartItem);

        $this->assertEquals($quantity * 2, $cart->get()[0]['quantity']);
        $this->assertEquals(90, $cart->get()[1]['quantity']);
    }
}
<?php

namespace AppBundle\Shop;


use AppBundle\Entity\Product;

class CartItem
{


    /**
     * @var Product $product
     */
    private $product;

    private $quantity;

    private $size;

    /**
     * @return mixed
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }


    public function toArray()
    {
        return array('id' => $this->getProduct()->getId(),
                     'quantity' => $this->getQuantity(),
                     'size' => $this->getSize(),
        );
    }
}
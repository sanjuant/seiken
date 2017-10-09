<?php

namespace AppBundle\Shop;


use AppBundle\Entity\Color;
use AppBundle\Entity\Product;
use AppBundle\Entity\Size;

class CartItem
{
    /**
     * @var Product $product
     */
    private $product;

    private $quantity;

    private $size;

    private $color;

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
        if ($size instanceof Size) {
            $this->size = $size->getMeasurement();
        } else {
            $this->size = $size;
        }
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        if ($color instanceof Color) {
            $this->color = $color->getName();
        } else {
            $this->color = $color;
        }
    }


    public function toArray()
    {
        return array(
            'id' => $this->getProduct()->getId(),
            'name' => $this->getProduct()->getName(),
            'price' => $this->getProduct()->getPrice(),
            'quantity' => $this->getQuantity(),
            'size' => $this->getSize(),
            'color' => $this->getColor(),
        );
    }
}
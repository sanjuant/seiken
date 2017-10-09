<?php

namespace AppBundle\Shop;

Interface CartInterface
{
    public function add(CartItem $item);

    public function remove($index);

    public function searchItem(CartItem $item);

    public function get(): array;
}
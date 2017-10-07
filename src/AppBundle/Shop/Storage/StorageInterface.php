<?php

namespace AppBundle\Shop\Storage;

use AppBundle\Shop\CartInterface;

Interface StorageInterface
{
    public function save(CartInterface $cart);

    public function load(): array;
}
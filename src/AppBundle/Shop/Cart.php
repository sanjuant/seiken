<?php

namespace AppBundle\Shop;


use AppBundle\Shop\Storage\StorageInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart implements CartInterface
{
    private $storage;
    private $cart = array();

    public function __construct(StorageInterface $session)
    {
        $this->storage = $session;

        $this->cart = $this->storage->load();
    }

    public function add(CartItem $item)
    {
        // Verifier qu'il n'existe pas déjà dans la collection

        if (null === $index = $this->searchItem($item)) {
            $this->cart[] = $item->toArray();
        } else {
            $this->cart[$index]['quantity'] += $item->getQuantity();
        }

        $this->save();

        return $this;
    }

    public function remove($index)
    {
        if (isset($this->cart[$index])) {
            unset($this->cart[$index]);
            $this->save();
        }
    }

    public function get(): array
    {
        return $this->cart;
    }

    public function searchItem(CartItem $item)
    {
        $tab = array_filter(
            $this->cart, function ($row) use ($item) {
            return $row['id'] == $item->getProduct()->getId()
                && $row['size'] == $item->getSize()
                && $row['color'] == $item->getColor();
        });

        if (count($tab) > 0) {
            return array_keys($tab)[0];
        }
    }

    private function save()
    {
        $this->storage->save($this);
    }
}
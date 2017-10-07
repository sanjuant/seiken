<?php

namespace AppBundle\Shop;


use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart implements CartInterface
{
    private $storage;
    private $cart = array();

    public function __construct(SessionInterface $session)
    {
        $this->storage = $session;
    }

    public function add(CartItem $item)
    {
        // Verifier qu'il n'existe pas déjà dans la collection

        if (null === $index = $this->searchItem($item)) {
            $this->cart[] = $item->toArray();
        } else {
            $this->cart[$index]['quantity'] += $item->getQuantity();
        }

        // Si il existe on incremente la qty

        // Sinon on creer une entrée avec qty = 1

        return $this;
    }

    public function remove(CartItem $item)
    {
        if (null !== $index = $this->searchItem($item)) {
            unset($this->cart[$index]);
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
                && $row['size'] == $item->getSize();
        });

        if (count($tab) > 0) {
            return array_keys($tab)[0];
        }
    }

    private function save()
    {

    }
}
<?php

namespace AppBundle\Shop\Storage;

use AppBundle\Shop\CartInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionStorage implements StorageInterface
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function save(CartInterface $cart)
    {
        $this->session->set('cart', $cart->get());
    }

    public function load(): array
    {
        return $this->session->get('cart', []);
    }
}
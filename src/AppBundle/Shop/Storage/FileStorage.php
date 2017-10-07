<?php

namespace AppBundle\Shop\Storage;

use AppBundle\Shop\CartInterface;

class FileStorage implements StorageInterface
{
    private $file;

    public function __construct($filePath)
    {
        $this->file = $filePath;
    }

    public function save(CartInterface $cart)
    {
        $handle = fopen($this->file, 'w');
        fputs($handle, serialize($cart->get()));
        fclose($handle);
    }

    public function load(): array
    {
        $handle = fopen($this->file, 'w');
        $string = file_get_contents($handle);

        return unserialize($string);
    }
}
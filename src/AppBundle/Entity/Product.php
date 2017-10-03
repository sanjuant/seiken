<?php

namespace AppBundle\Entity;


use AppBundle\Model\CategorizableInterface;
use AppBundle\Traits\Id;

class Product implements CategorizableInterface
{
    use Id;


    public function setCategory(AbstractCategory $category)
    {
        // TODO: Implement setCategory() method.
    }

    public function getCategory()
    {
        // TODO: Implement getCategory() method.
    }
}
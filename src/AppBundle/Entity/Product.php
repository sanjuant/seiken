<?php

namespace AppBundle\Entity;


use AppBundle\Model\CategorizableInterface;
use AppBundle\Traits\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="products")
 */
class Product implements CategorizableInterface
{
    use Id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=2)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $ref;


    public function setCategory(AbstractCategory $category)
    {
        // TODO: Implement setCategory() method.
    }

    public function getCategory()
    {
        // TODO: Implement getCategory() method.
    }
}
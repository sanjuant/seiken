<?php

namespace AppBundle\Entity;

use AppBundle\Traits\Id;
use AppBundle\Traits\Label;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="types")
 */
class Type
{
    use Id;

    use Label;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="type")
     */
    private $products;

    private $sizes;
}
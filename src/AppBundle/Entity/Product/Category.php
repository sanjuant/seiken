<?php

namespace AppBundle\Entity\Product;

use AppBundle\Entity\AbstractCategory;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="categories_product")
 */
class Category extends AbstractCategory
{

}
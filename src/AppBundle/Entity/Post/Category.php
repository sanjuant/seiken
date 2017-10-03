<?php

namespace AppBundle\Entity\Post;

use AppBundle\Entity\AbstractCategory;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="categories_post")
 */
class Category extends AbstractCategory
{

}
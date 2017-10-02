<?php

namespace AppBundle\Entity\Category;

use AppBundle\Entity\CategoryInterface;
use AppBundle\Traits\Id;
use AppBundle\Traits\Label;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="categories_product")
 */
class Product implements CategoryInterface
{
    use Id;

    use Label;

    public function __toString(): string
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return CategoryInterface
     */
    public function setLabel($label): CategoryInterface
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

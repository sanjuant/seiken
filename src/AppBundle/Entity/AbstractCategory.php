<?php

namespace AppBundle\Entity;

use AppBundle\Traits\Id;
use AppBundle\Traits\Label;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity("label")
 */
abstract class AbstractCategory
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
     * @return AbstractCategory
     */
    public function setLabel($label): AbstractCategory
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

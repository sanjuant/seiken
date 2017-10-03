<?php

namespace AppBundle\Entity;

use AppBundle\Traits\Id;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity("label")
 */
abstract class AbstractCategory
{
    use Id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="25")
     */
    protected $label;

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

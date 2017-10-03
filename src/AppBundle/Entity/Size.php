<?php

namespace AppBundle\Entity;


use AppBundle\Traits\Id;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="sizes")
 */
class Size
{
    use Id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="25")
     */
    private $measurement;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Type", inversedBy="sizes")
     */
    private $type;

    /**
     * Set measurement
     *
     * @param string $measurement
     *
     * @return Size
     */
    public function setMeasurement($measurement)
    {
        $this->measurement = $measurement;

        return $this;
    }

    /**
     * Get measurement
     *
     * @return string
     */
    public function getMeasurement()
    {
        return $this->measurement;
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

    /**
     * Set type
     *
     * @param \AppBundle\Entity\Type $type
     *
     * @return Size
     */
    public function setType(\AppBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }
}

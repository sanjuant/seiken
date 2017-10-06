<?php

namespace AppBundle\Entity;

use AppBundle\Traits\Id;
use AppBundle\Traits\Label;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeRepository")
 * @ORM\Table(name="types")
 */
class Type
{
    use Id;

    use Label;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product", mappedBy="type")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Size", mappedBy="type", cascade="all", orphanRemoval=true)
     */
    private $sizes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sizes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
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

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Type
     */
    public function setLabel($label)
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
     * Add product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Type
     */
    public function addProduct(\AppBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \AppBundle\Entity\Product $product
     */
    public function removeProduct(\AppBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add size
     *
     * @param \AppBundle\Entity\Size $size
     *
     * @return Type
     */
    public function addSize(\AppBundle\Entity\Size $size)
    {
        $this->sizes[] = $size;
        $size->setType($this);

        return $this;
    }

    /**
     * Remove size
     *
     * @param \AppBundle\Entity\Size $size
     */
    public function removeSize(\AppBundle\Entity\Size $size)
    {
        $this->sizes->removeElement($size);
    }

    /**
     * Get sizes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSizes()
    {
        return $this->sizes;
    }
}

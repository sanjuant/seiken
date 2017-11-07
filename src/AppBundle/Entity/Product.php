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
     * @ORM\Column(type="text")
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

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product\Image", mappedBy="product", cascade="all", orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product\Category", inversedBy="products")
     * @ORM\JoinColumn(onDelete="RESTRICT")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Color", cascade={"persist"})
     */
    private $colors;

    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="products")
     */
    private $type;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->colors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set category
     *
     * @param AbstractCategory $category
     *
     * @return Product
     */
    public function setCategory(AbstractCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Product\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function __toString(): string
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set ref
     *
     * @param string $ref
     *
     * @return Product
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
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
     * Add image
     *
     * @param \AppBundle\Entity\Product\Image $image
     *
     * @return Product
     */
    public function addImage(\AppBundle\Entity\Product\Image $image)
    {
        $this->images[] = $image;
        $image->setProduct($this);

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Product\Image $image
     */
    public function removeImage(\AppBundle\Entity\Product\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add color
     *
     * @param \AppBundle\Entity\Color $color
     *
     * @return Product
     */
    public function addColor(\AppBundle\Entity\Color $color)
    {
        $this->colors[] = $color;

        return $this;
    }

    /**
     * Remove color
     *
     * @param \AppBundle\Entity\Color $color
     */
    public function removeColor(\AppBundle\Entity\Color $color)
    {
        $this->colors->removeElement($color);
    }

    /**
     * Get colors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\Type $type
     *
     * @return Product
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

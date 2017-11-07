<?php

namespace AppBundle\Entity\Product;

use AppBundle\Traits\Id;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity()
 * @ORM\Table(name="images")
 * @Vich\Uploadable
 */
class Image
{
    use Id;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="name")
     * @Assert\File(maxSize = "2M")
     *
     * @var File
     */
    private $file;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uploadAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="images")
     */
    private $product;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return Image
     */
    public function setFile(File $file = null)
    {
        $this->file = $file;
        if ($file) {
            $this->uploadAt = new \DateTime();
        }
        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Image
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
     * Set uploadAt
     *
     * @param \DateTime $uploadAt
     *
     * @return Image
     */
    public function setUploadAt($uploadAt)
    {
        $this->uploadAt = $uploadAt;

        return $this;
    }

    /**
     * Get uploadAt
     *
     * @return \DateTime
     */
    public function getUploadAt()
    {
        return $this->uploadAt;
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
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Image
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}

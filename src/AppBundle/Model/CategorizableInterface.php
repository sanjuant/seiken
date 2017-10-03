<?php

namespace AppBundle\Model;

use AppBundle\Entity\AbstractCategory;

interface CategorizableInterface
{
    public function setCategory(AbstractCategory $category);

    public function getCategory();

}
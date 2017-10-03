<?php

namespace AppBundle\Traits;

use Doctrine\ORM\Mapping as ORM;

trait Id
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
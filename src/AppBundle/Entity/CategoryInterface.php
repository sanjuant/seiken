<?php

namespace AppBundle\Entity;


interface CategoryInterface
{
    public function __toString(): string;

    public function setLabel($label): CategoryInterface;

    public function getLabel();

    public function getId();
}
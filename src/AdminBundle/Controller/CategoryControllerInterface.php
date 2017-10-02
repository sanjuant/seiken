<?php

namespace AdminBundle\Controller;


use AppBundle\Entity\CategoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface CategoryControllerInterface
{
    public function indexAction(): Response;

    public function addAction(Request $request);

    public function editAction(CategoryInterface $category, Request $request);

    public function deleteAction(CategoryInterface $category);
}
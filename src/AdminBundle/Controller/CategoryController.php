<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\CategoryType;
use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class CategoryController extends Controller
{

    /**
     * @Route("/categories", name="admin.categories")
     */
    public function indexAction()
    {
        // SELECT * FROM categories;
        $categories = $this
            ->getDoctrine()
            ->getRepository(Category::class)
            ->findAll()
        ;

        return $this->render('@Admin/Category/index.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @Route("/category/add", name="admin.category.add")
     */
    public function addAction(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('admin.categories');
        }

        return $this->render('@Admin/Category/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/category/edit/{id}", name="admin.category.edit")
     */
    public function editAction(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.categories');
        }

        return $this->render('@Admin/Category/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/category/delete/{id}", name="admin.category.delete")
     */
    public function deleteAction(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('admin.categories');
    }
}

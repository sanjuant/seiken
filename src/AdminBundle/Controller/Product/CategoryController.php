<?php

namespace AdminBundle\Controller\Product;

use AdminBundle\Form\Product\CategoryType;
use AppBundle\Entity\Product\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/product")
 */
class CategoryController extends Controller
{

    /**
     * @Route("/categories", name="admin.product.categories")
     */
    public function indexAction(): Response
    {
        // SELECT * FROM categories_product;
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
     * @Route("/category/add", name="admin.product.category.add")
     */
    public function addAction(Request $request)
    {
        $product = new Category();

        $form = $this->createForm(CategoryType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('admin.product.categories');
        }

        return $this->render('@Admin/Category/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/category/edit/{id}", name="admin.product.category.edit")
     */
    public function editAction(Category $product, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.product.categories');
        }

        return $this->render('@Admin/Category/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/category/delete/{id}", name="admin.product.category.delete")
     */
    public function deleteAction(Category $product)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('admin.product.categories');
    }
}

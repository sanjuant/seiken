<?php

namespace AdminBundle\Controller\Category;

use AdminBundle\Controller\CategoryControllerInterface;
use AdminBundle\Form\Category\ProductType as CategoryProductType;
use AppBundle\Entity\Category\Product as CategoryProduct;
use AppBundle\Entity\CategoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/category")
 */
class ProductController extends Controller implements CategoryControllerInterface
{

    /**
     * @Route("/product", name="admin.category.product")
     */
    public function indexAction(): Response
    {
        // SELECT * FROM categories_post;
        $categories = $this
            ->getDoctrine()
            ->getRepository(CategoryProduct::class)
            ->findAll()
        ;

        return $this->render('@Admin/Category/index.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @Route("/product/add", name="admin.category.product.add")
     */
    public function addAction(Request $request)
    {
        $product = new CategoryProduct();

        $form = $this->createForm(CategoryProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('admin.category.product');
        }

        return $this->render('@Admin/Category/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/product/edit/{id}", name="admin.category.product.edit")
     */
    public function editAction(CategoryInterface $product, Request $request)
    {
        $form = $this->createForm(CategoryProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.category.product');
        }

        return $this->render('@Admin/Category/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/product/delete/{id}", name="admin.category.product.delete")
     */
    public function deleteAction(CategoryInterface $product)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('admin.category.product');
    }
}

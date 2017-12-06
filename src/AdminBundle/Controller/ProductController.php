<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\ProductType;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class ProductController extends Controller
{
    public $module = "boutique";

    /**
     * @Route("/products", name="admin.products")
     */
    public function indexAction()
    {
        // SELECT * FROM posts;
        $posts = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->findAll()
        ;

        return $this->render('@Admin/Product/index.html.twig', array(
            'products' => $posts
        ));
    }

    /**
     * @Route("/product/add", name="admin.product.add")
     */
    public function addAction(Request $request)
    {
        $post = new Product();

        $form = $this->createForm(ProductType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('admin.products');
        }

        return $this->render('@Admin/Product/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/product/edit/{id}", name="admin.product.edit")
     *
     * @param Product $product
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Product $product, Request $request)
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.products');
        }

        return $this->render('@Admin/Product/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/product/delete/{id}", name="admin.product.delete")
     */
    public function deleteAction(Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('admin.products');
    }
}

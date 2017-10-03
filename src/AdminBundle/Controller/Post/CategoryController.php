<?php

namespace AdminBundle\Controller\Post;

use AdminBundle\Form\Post\CategoryType;
use AppBundle\Entity\Post\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/post")
 */
class CategoryController extends Controller
{
    public $module = "post.category";

    /**
     * @Route("/categories", name="admin.post.categories")
     */
    public function indexAction(): Response
    {
        // SELECT * FROM categories_post;
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
     * @Route("/category/add", name="admin.post.category.add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
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

            return $this->redirectToRoute('admin.post.categories');
        }

        return $this->render('@Admin/Category/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/category/edit/{id}", name="admin.post.category.edit")
     * @param Category $category
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.post.categories');
        }

        return $this->render('@Admin/Category/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/category/delete/{id}", name="admin.post.category.delete")
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('admin.post.categories');
    }
}

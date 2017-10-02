<?php

namespace AdminBundle\Controller\Category;

use AdminBundle\Form\Category\PostType as CategoryPostType;
use AppBundle\Entity\Category\Post as CategoryPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/category")
 */
class PostController extends Controller
{

    /**
     * @Route("/post", name="admin.category.post")
     */
    public function indexAction(): Response
    {
        // SELECT * FROM categories_post;
        $categories = $this
            ->getDoctrine()
            ->getRepository(CategoryPost::class)
            ->findAll()
        ;

        return $this->render('@Admin/Category/index.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @Route("/post/add", name="admin.category.post.add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        $category = new CategoryPost();

        $form = $this->createForm(CategoryPostType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('admin.category.post');
        }

        return $this->render('@Admin/Category/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/post/edit/{id}", name="admin.category.post.edit")
     * @param CategoryPost $category
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction(CategoryPost $category, Request $request)
    {
        $form = $this->createForm(CategoryPostType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.category.post');
        }

        return $this->render('@Admin/Category/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/post/delete/{id}", name="admin.category.post.delete")
     * @param CategoryPost $category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(CategoryPost $category)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('admin.category.post');
    }
}

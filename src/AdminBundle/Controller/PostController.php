<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Post;
use AdminBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class PostController extends Controller
{
    public $module = "news";

    /**
     * @Route("/posts", name="admin.posts")
     */
    public function indexAction()
    {
        // SELECT * FROM posts;
        $posts = $this
            ->getDoctrine()
            ->getRepository(Post::class)
            ->findAll()
        ;

        return $this->render('@Admin/Post/index.html.twig', array(
            'posts' => $posts
        ));
    }

    /**
     * @Route("/post/add", name="admin.post.add")
     */
    public function addAction(Request $request)
    {
        $post = new Post();
        $post->setDate(new \DateTime());

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('admin.posts');
        }

        return $this->render('@Admin/Post/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/post/edit/{id}", name="admin.post.edit")
     *
     * @param Post $post
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Post $post, Request $request)
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.posts');
        }

        return $this->render('@Admin/Post/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/post/delete/{id}", name="admin.post.delete")
     */
    public function deleteAction(Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('admin.posts');
    }
}

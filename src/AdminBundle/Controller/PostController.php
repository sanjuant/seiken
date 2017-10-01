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

    /**
     * @Route("/posts", name="admin.posts")
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $this->render('@Admin/Post/index.html.twig', array(
            'posts' => $posts
        ));
    }

    /**
     * @Route("/add", name="admin.post.add")
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
     * @Route("/edit", name="admin.post.edit")
     */
    public function editAction()
    {
        return $this->render('@Admin/Post/index.html.twig');
    }

    /**
     * @Route("/delete", name="admin.post.delete")
     */
    public function deleteAction()
    {
        return $this->render('@Admin/Post/index.html.twig');
    }
}

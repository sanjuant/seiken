<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/news")
 */
class NewsController extends Controller
{
    /**
     * @Route("", name="news")
     */
    public function indexAction()
    {

        $posts = $this->getDoctrine()->getRepository(Post::class)->findAllWithComments();


        return $this->render('@App/News/news.html.twig', array(
            'posts' => $posts,
            'img' => 'assets/img/news.jpg',
            'position' => 'center'
        ));
    }

    /**
     * @Route("/{id}", name="news.post")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, Request $request)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneWithComments($id);

        $comment = new Comment();
        $comment->setPost($post);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('news.post', array('id' => $id));
        }

        return $this->render('@App/News/view.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
            'img' => 'assets/img/news.jpg',
            'position' => 'center'
        ));
    }
}
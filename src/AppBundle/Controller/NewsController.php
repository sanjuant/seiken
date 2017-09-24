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
        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy(array(), array('date' => 'DESC'));


        return $this->render('@App/News/news.html.twig', array(
            'posts' => $posts,
            'img' => 'assets/img/news.jpg',
            'position' => 'center'
        ));
    }

    /**
     * @Route("/{id}", name="news.post")
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Post $post, Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        return $this->render('@App/News/view.html.twig', array(
            'form' => $form->createView(),
            'post' => $post,
            'img' => 'assets/img/news.jpg',
            'position' => 'center'
        ));
    }
}
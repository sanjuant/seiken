<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    public function viewAction(Post $post)
    {
        return $this->render('@App/News/view.html.twig', array(
            'post' => $post,
            'img' => 'assets/img/news.jpg',
            'position' => 'center'
        ));
    }
}
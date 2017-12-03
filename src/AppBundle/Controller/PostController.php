<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/news")
 */
class PostController extends Controller
{
    /**
     * @Route("/{page}", name="news", requirements={"page": "\d+"})
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page = 1)
    {
        if ($page < 1) {
            // We trigger a NotFoundHttpException exception, this will display
            // A 404 error page
            throw new NotFoundHttpException('Page "' . $page . '" inexistante.');
        }

        // We define number of post per page
        $nbPerPage = 5;

        // We're getting the post list
        $posts = $this->getDoctrine()
                      ->getRepository(Post::class)
                      ->findAllWithComments($page, $nbPerPage)
        ;

        // We calculate the total number of pages with the count ($Posts) which returns the total number of posts
        $nbPages = ceil(count($posts) / $nbPerPage);

        return $this->render('@App/News/news.html.twig', array(
            'posts' => $posts,
            'nbPages' => $nbPages,
            'page' => $page,
            'img' => 'assets/img/news.jpg',
            'position' => 'center'
        ));
    }

    /**
     * @Route("/{slug}", name="news.post")
     * @param $slug
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($slug, Request $request)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneWithComments($slug);

        $comment = new Comment();
        $comment->setPost($post);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('news.post', array('slug' => $slug));
        }

        return $this->render('@App/News/view.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
            'img' => 'assets/img/news.jpg',
            'position' => 'center'
        ));
    }
}
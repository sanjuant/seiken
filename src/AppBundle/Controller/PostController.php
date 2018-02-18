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
        // Si la page est inférieure à 1 alors on affiche une exception.
        if ($page < 1) {
            throw new NotFoundHttpException('Page "' . $page . '" inexistante.');
        }

        // On défini le nombre de news par page
        $nbPerPage = 5;

        // On récupère la liste des Posts
        // SELECT * FROM posts LEFT JOIN comments ON posts.id = comments.post_id;
        $posts = $this->getDoctrine()
                      ->getRepository(Post::class)
                      ->findAllWithComments($page, $nbPerPage)
        ;

        // On calcule le nombre de page grace au nombre de Posts
        $nbPages = ceil(count($posts) / $nbPerPage);

        // On retournes les posts, le nombres de pages, la page, l'img de l'entête et sa position
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
        // On récupère le post
        // SELECT * FROM posts LEFT JOIN comments ON posts.id = comments.post_id WHERE posts.id = :slug;
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneWithComments($slug);

        // On creer un objet comment
        $comment = new Comment();

        // On lui attribut un post
        $comment->setPost($post);

        // On creer le formulaire
        $form = $this->createForm(CommentType::class, $comment);

        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $comment contient les valeurs entrées dans le formulaire par le visiteur
        $form->handleRequest($request);

        // On vérifie que le formulaire a été envoyé (POST) et que les valeurs entrées sont correctes
        if ($form->isSubmitted() && $form->isValid()) {
            // On recupère l'entity manager
            $em = $this->getDoctrine()->getManager();
            // On persiste les données
            $em->persist($form->getData());
            $em->flush();

            // On redirige vers la page de la news
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
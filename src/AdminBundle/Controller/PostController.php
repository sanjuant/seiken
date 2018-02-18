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
        // On récupère la liste de tout les posts
        // SELECT * FROM posts;
        $posts = $this
            ->getDoctrine()
            ->getRepository(Post::class)
            ->findAll()
        ;

        // On retourne les posts
        return $this->render('@Admin/Post/index.html.twig', array(
            'posts' => $posts
        ));
    }

    /**
     * @Route("/post/add", name="admin.post.add")
     */
    public function addAction(Request $request)
    {
        // On creer un objet Post
        $post = new Post();
        // On défini la date par default sur la date actuelle
        $post->setDate(new \DateTime());

        // On creer le formulaire
        $form = $this->createForm(PostType::class, $post);
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

            // On redirige vers la liste des posts
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
        // On creer le formulaire d'édition en lui passant l'objet Post a modifier
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        // On vérifie que le formulaire a été envoyé (POST) et que les valeurs entrées sont correctes
        if ($form->isSubmitted() && $form->isValid()) {
            // On persiste les données
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
        // On récupère l'entity manager
        $em = $this->getDoctrine()->getManager();
        // On supprime le Post qui à été passé en paramètre
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('admin.posts');
    }
}

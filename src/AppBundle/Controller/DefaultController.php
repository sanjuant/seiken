<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('accueil');
    }

    /**
     * @Route("/accueil", name="accueil")
     * @Method("GET")
     */
    public function accueilAction()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy(array(), array(
            'date' => 'DESC'
        ))
        ;

        return $this->render('@App/Default/accueil.html.twig', array(
            'posts' => $posts,
            'img' => 'assets/img/accueil.jpg',
            'position' => 'bottom'
        ));
    }

    /**
     * @Route("/body-karate", name="body-karate")
     * @Method("GET")
     */
    public function bodyKarateAction()
    {
        return $this->render('@App/Default/body-karate.html.twig', array(
            'img' => 'assets/img/body-karate.jpg',
            'position' => 'top'
        ));
    }

    /**
     * @Route("/coaching", name="coaching")
     * @Method("GET")
     */
    public function coachingAction()
    {
        return $this->render('@App/Default/coaching.html.twig', array(
            'img' => 'assets/img/coaching.jpg',
            'position' => 'bottom'
        ));
    }

    /**
     * @Route("/club", name="club")
     * @Method("GET")
     */
    public function clubAction()
    {
        return $this->render('@App/Default/club.html.twig', array(
            'img' => 'assets/img/club.jpg',
            'position' => 'bottom'
        ));
    }

    /**
     * @Route("/boutique", name="boutique")
     * @Method("GET")
     */
    public function boutiqueAction()
    {
        return $this->render('@App/Default/boutique.html.twig', array(
            'img' => 'assets/img/boutique.jpg',
            'position' => 'center'
        ));
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('@App/Default/contact.html.twig', array(
            'img' => 'assets/img/contact.jpg',
            'position' => 'center'
        ));
    }
}

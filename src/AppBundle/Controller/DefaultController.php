<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Member;
use AppBundle\Entity\Post;
use AppBundle\Entity\Product;
use AppBundle\Form\ContactType;
use AppBundle\Form\MemberType;
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
     */
    public function accueilAction()
    {
        $posts = $this
            ->getDoctrine()
            ->getRepository(Post::class)
            ->findBy(
                array(),
                array('date' => 'DESC'),
                3,
                0
            )
        ;

        return $this->render('@App/Default/accueil.html.twig', array(
            'posts' => $posts,
            'img' => 'assets/img/accueil.jpg',
            'position' => 'bottom'
        ));
    }

    /**
     * @Route("/body-karate", name="body-karate")
     */
    public function bodyKarateAction()
    {
        return $this->render(':parts', array(
            'img' => 'assets/img/body-karate.jpg',
            'position' => 'top'
        ));
    }

    /**
     * @Route("/coaching", name="coaching")
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
     */
    public function clubAction()
    {
        return $this->render('@App/Default/club.html.twig', array(
            'img' => 'assets/img/club.jpg',
            'position' => 'bottom'
        ));
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(ContactType::class, null, array(
            'method' => 'POST'
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $data = $form->getData();
                $message = '';

                foreach ($data as $key => $value) {
                    $message = $message . $key . ' : ' . $value . PHP_EOL;
                }

                $mailer = $this->get('app.mailer');
                $mailer
                    ->setObject($data['subject'])
                    ->setMessage($message)
                    ->setSender($data['email'])
                    ->setRecipient('contact@sanjuant.fr')
                    ->send()
                ;
                $request->getSession()->getFlashBag()->add('success', 'L\'email à bien été envoyé');
            } catch (\Exception $e) {
                $request->getSession()->getFlashBag()->add('error', 'L\'email n\'à pas été envoyé');
            }

            return $this->redirectToRoute('contact');
        }

        return $this->render('@App/Default/contact.html.twig', array(
            'form' => $form->createView(),
            'img' => 'assets/img/contact.jpg',
            'position' => 'center'
        ));
    }

    /**
     * @Route("/affiliate", name="affiliate")
     */
    public function affiliateAction(Request $request)
    {
        $member = new Member();

        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('@App/Default/affiliate.html.twig', array(
            'img' => 'assets/img/contact.jpg',
            'position' => 'center',
            'form' => $form->createView()
        ));
    }
}

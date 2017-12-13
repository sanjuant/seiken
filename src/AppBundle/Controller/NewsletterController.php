<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Newsletter;
use AppBundle\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewsletterController extends Controller
{
    public function addAction(Request $request)
    {
        $newsletter = new Newsletter();

        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            unset($newsletter);
            unset($form);

            $newsletter = new Newsletter();
            $form = $this->createForm(NewsletterType::class, $newsletter);
        }

        return $this->render(':parts:newsletter.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

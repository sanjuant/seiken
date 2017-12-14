<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\NewsletterFormType;
use AppBundle\Entity\Newsletter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class NewsletterController extends Controller
{
    public $module = "newsletters";

    /**
     * @Route("/newsletters", name="admin.newsletters")
     */
    public function indexAction()
    {
        // SELECT * FROM posts;
        $newsletters = $this
            ->getDoctrine()
            ->getRepository(Newsletter::class)
            ->findAll()
        ;

        return $this->render('@Admin/Newsletter/index.html.twig', array(
            'newsletters' => $newsletters
        ));
    }

    /**
     * @Route("/newsletter/delete/{id}", name="admin.newsletter.delete")
     */
    public function deleteAction(Newsletter $newsletter)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($newsletter);
        $em->flush();

        return $this->redirectToRoute('admin.newsletters');
    }


    /**
     * @Route("/newsletter/send", name="admin.newsletter.send")
     */
    public function sendAction(Request $request)
    {
        $newsletters = $this->getDoctrine()->getRepository(Newsletter::class)->findAll();
        $recipient = [];
        foreach ($newsletters as $newsletter) {
            $recipient[] = $newsletter->getEmail();
        }

        $form = $this->createForm(NewsletterFormType::class, null, array(
            'method' => 'POST'
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $mailer = $this->get('app.mailer');
            $mailer
                ->setObject($data['subject'])
                ->setMessage($data['content'])
                ->setSender($this->getParameter('email_address'))
                ->setRecipient($recipient)
                ->setContentType('text/html')
                ->send()
            ;

            return $this->redirectToRoute('admin.newsletters');
        }

        return $this->render('@Admin/Newsletter/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
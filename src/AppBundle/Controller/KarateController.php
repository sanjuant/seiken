<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/karate-contact")
 */
class KarateController extends Controller
{
    /**
     * @Route("/jeune-enfant", name="kc.jeune-enfant")
     * @Method("GET")
     */
    public function jeuneEnfantAction()
    {
        return $this->render('@App/KarateContact/jeune-enfant.html.twig', array(
            'img' => 'assets/img/jeune-enfant.jpg',
            'position' => 'center'
        ));
    }

    /**
     * @Route("/enfant", name="kc.enfant")
     * @Method("GET")
     */
    public function enfantAction()
    {
        return $this->render('@App/KarateContact/enfant.html.twig', array(
            'img' => 'assets/img/enfant.jpg',
            'position' => 'top'
        ));
    }

    /**
     * @Route("/ado-adulte", name="kc.ado-adulte")
     * @Method("GET")
     */
    public function adoAdulteAction()
    {
        return $this->render('@App/KarateContact/ado-adulte.html.twig', array(
            'img' => 'assets/img/ado-adulte.jpg',
            'position' => 'top'
        ));
    }
}

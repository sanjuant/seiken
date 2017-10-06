<?php

namespace AdminBundle\Controller\Product;

use AdminBundle\Form\ColorType;
use AppBundle\Entity\Color;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/product")
 */
class ColorController extends Controller
{
    public $module = "product.color";

    /**
     * @Route("/colors", name="admin.product.colors")
     */
    public function indexAction(): Response
    {
        // SELECT * FROM colors;
        $colors = $this
            ->getDoctrine()
            ->getRepository(Color::class)
            ->findAll()
        ;

        return $this->render('@Admin/Color/index.html.twig', array(
            'colors' => $colors
        ));
    }

    /**
     * @Route("/color/add", name="admin.product.color.add")
     */
    public function addAction(Request $request)
    {
        $color = new Color();

        $form = $this->createForm(ColorType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('admin.product.colors');
        }

        return $this->render('@Admin/Color/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/color/edit/{id}", name="admin.product.color.edit")
     */
    public function editAction(Color $color, Request $request)
    {
        $form = $this->createForm(ColorType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.product.colors');
        }

        return $this->render('@Admin/Color/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/color/delete/{id}", name="admin.product.color.delete")
     */
    public function deleteAction(Color $color)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($color);
        $em->flush();

        return $this->redirectToRoute('admin.product.colors');
    }
}

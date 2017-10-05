<?php

namespace AdminBundle\Controller\Product;

use AdminBundle\Form\TypeType;
use AppBundle\Entity\Size;
use AppBundle\Entity\Type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/product")
 */
class TypeController extends Controller
{
    public $module = "type";

    /**
     * @Route("/types", name="admin.product.types")
     */
    public function indexAction()
    {
        // SELECT * FROM posts;
        $types = $this
            ->getDoctrine()
            ->getRepository(Type::class)
            ->findAll()
        ;

        return $this->render('@Admin/Type/index.html.twig', array(
            'types' => $types
        ));
    }

    /**
     * @Route("/type/add", name="admin.product.type.add")
     */
    public function addAction(Request $request)
    {
        $type = new Type();

        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('admin.product.types');
        }

        return $this->render('@Admin/Type/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/product/type/edit/{id}", name="admin.product.type.edit")
     *
     * @param Type $type
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Type $type, Request $request)
    {
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.product.types');
        }

        return $this->render('@Admin/Type/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/product/type/delete/{id}", name="admin.product.type.delete")
     */
    public function deleteAction(Type $type)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($type);
        $em->flush();

        return $this->redirectToRoute('admin.product.types');
    }
}

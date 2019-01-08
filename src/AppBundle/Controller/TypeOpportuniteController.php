<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\TypeOpportunite;

/**
 * TypeOpportunite controller.
 *
 * @Route("typeOpportunite")
 */
class TypeOpportuniteController extends Controller {

    /**
     * @Route("/", name="typeOpportunite_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $typeOpportunites = $em->getRepository('AppBundle:TypeOpportunite')->findby([], ["libelle" => "desc"]);

        return $this->render('@App/TypeOpportunite/index.html.twig', array(
                    'typeOpportunites' => $typeOpportunites,
        ));
    }

    /**
     * @Route("/new", name="typeOpportunite_new")
     */
    public function newAction(Request $request) {
        $typeOpportunite = new TypeOpportunite();
        $form = $this->createForm('AppBundle\Form\TypeOpportuniteType', $typeOpportunite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($typeOpportunite);
            $em->flush();


            $this->addFlash("success", "Le typeOpportunite a été ajouté avec succès");

            return $this->redirectToRoute('typeOpportunite_index');
        }

        return $this->render('@App/TypeOpportunite/new.html.twig', array(
                    'typeOpportunite' => $typeOpportunite,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="typeOpportunite_edit")
     */
    public function editAction(Request $request, TypeOpportunite $typeOpportunite) {
        $editForm = $this->createForm('AppBundle\Form\TypeOpportuniteType', $typeOpportunite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le typeOpportunite a été modifié avec succès");

            return $this->redirectToRoute('typeOpportunite_index');
        }

        return $this->render('@App/TypeOpportunite/edit.html.twig', array(
                    'typeOpportunite' => $typeOpportunite,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "typeOpportunite_delete")
     */
    public function deleteAction(Request $request, TypeOpportunite $typeOpportunite) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le typeOpportunite a été supprimé avec succès");
        $em->remove($typeOpportunite);
        $em->flush();

        return $this->redirectToRoute('typeOpportunite_index');
    }

}

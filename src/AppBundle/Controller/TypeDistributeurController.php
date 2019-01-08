<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\TypeDistributeur;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("typedistributeur")
 */
class TypeDistributeurController extends Controller {

    /**
     * @Route("/", name="typedistributeur_index")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $typeDistributeurs = $em->getRepository("AppBundle:TypeDistributeur")->findAll();

        return $this->render('@App/TypeDistributeur/index.html.twig', array(
                    "typeDistributeurs" => $typeDistributeurs,
        ));
    }

    /**
     * @Route("/new", name="typedistributeur_new")
     */
    public function newAction(Request $request) {
        $typeDistributeur = new TypeDistributeur();
        $form = $this->createForm("AppBundle\Form\TypeDistributeurType", $typeDistributeur);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeDistributeur);
            $em->flush();
            $this->addFlash("success", "Type de distributeur ajouté avec succès");

            return $this->redirectToRoute('typedistributeur_index');
        }

        return $this->render('@App/TypeDistributeur/new.html.twig', array(
                    "typeDistributeur" => $typeDistributeur,
                    "form" => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="typedistributeur_edit")
     */
    public function editAction(Request $request, TypeDistributeur $typeDistributeur) {
        $editForm = $this->createForm("AppBundle\Form\TypeDistributeurType", $typeDistributeur);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() and $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($typeDistributeur);
            $em->flush();
            $this->addFlash("success", "Type de distributeur modifié avec succès");

            return $this->redirectToRoute('typedistributeur_index');
        }

        return $this->render('@App/TypeDistributeur/edit.html.twig', array(
                    "typeDistributeur" => $typeDistributeur,
                    "form" => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name="typedistributeur_delete")
     */
    public function deleteAction(Request $request, TypeDistributeur $typeDistributeur) {
        $em = $this->getDoctrine()->getManager();

        $em->remove($typeDistributeur);
        $em->flush();
        $this->addFlash("success", "Type de distributeur supprimé avec succès");

        return $this->redirectToRoute('typedistributeur_index');
    }

}

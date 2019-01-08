<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Distributeur;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("distributeur")
 */
class DistributeurController extends Controller {

    /**
     * @Route("/", name="distributeur_index")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $distributeurs = $em->getRepository("AppBundle:Distributeur")->findAll();

        return $this->render('AppBundle:Distributeur:index.html.twig', array(
                    "distributeurs" => $distributeurs
        ));
    }

    /**
     * @Route("/new", name="distributeur_new")
     */
    public function newAction(Request $request) {
        $distributeur = new Distributeur();
        $form = $this->createForm("AppBundle\Form\DistributeurType", $distributeur);

        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($distributeur);
            $em->flush();

            $this->addFlash("success", "Distributeur ajouté avec succès");

            return $this->redirectToRoute('distributeur_index');
        }

        return $this->render('AppBundle:Distributeur:new.html.twig', array(
                    "distributeur" => $distributeur,
                    "form" => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="distributeur_edit")
     */
    public function editAction(Request $request, Distributeur $distributeur) {
        $editForm = $this->createForm("AppBundle\Form\DistributeurType", $distributeur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() and $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($distributeur);
            $em->flush();

            $this->addFlash("success", "Distributeur ajouté avec succès");

            return $this->redirectToRoute('distributeur_index');
        }

        return $this->render('AppBundle:Distributeur:edit.html.twig', array(
                    "distributeur" => $distributeur,
                    "form" => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name="distributeur_delete")
     */
    public function deleteAction(Distributeur $distributeur) {
        $em = $this->getDoctrine()->getManager();

        $em->remove($distributeur);
        $em->flush();
        return $this->redirectToRoute('distributeur_delete');
    }

}

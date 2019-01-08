<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\CategorieProduit;

/**
 * CategorieProduit controller.
 *
 * @Route("categorieProduit")
 */
class CategorieProduitController extends Controller {

    /**
     * @Route("/", name="categorieProduit_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $categorieProduits = $em->getRepository('AppBundle:CategorieProduit')->findby([], ["libelle" => "desc"]);

        return $this->render('@App/CategorieProduit/index.html.twig', array(
                    'categorieProduits' => $categorieProduits,
        ));
    }

    /**
     * @Route("/new", name="categorieProduit_new")
     */
    public function newAction(Request $request) {
        $categorieProduit = new CategorieProduit();
        $form = $this->createForm('AppBundle\Form\CategorieProduitType', $categorieProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieProduit);
            $em->flush();

            $this->addFlash("success", "Le categorieProduit a été ajouté avec succès");

            return $this->redirectToRoute('categorieProduit_index');
        }

        return $this->render('@App/CategorieProduit/new.html.twig', array(
                    'categorieProduit' => $categorieProduit,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="categorieProduit_edit")
     */
    public function editAction(Request $request, CategorieProduit $categorieProduit) {
        $editForm = $this->createForm('AppBundle\Form\CategorieProduitType', $categorieProduit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le categorieProduit a été modifié avec succès");

            return $this->redirectToRoute('categorieProduit_index');
        }

        return $this->render('@App/CategorieProduit/edit.html.twig', array(
                    'categorieProduit' => $categorieProduit,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "categorieProduit_delete")
     */
    public function deleteAction(Request $request, CategorieProduit $categorieProduit) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le categorieProduit a été supprimé avec succès");
        $em->remove($categorieProduit);
        $em->flush();

        return $this->redirectToRoute('categorieProduit_index');
    }

}

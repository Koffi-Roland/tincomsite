<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Partenaire;

/**
 * Partenaire controller.
 *
 * @Route("partenaire")
 */
class PartenaireController extends Controller {

    /**
     * @Route("/", name="partenaire_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $partenaires = $em->getRepository('AppBundle:Partenaire')->findby([], ["nom" => "desc"]);

        return $this->render('@App/Partenaire/index.html.twig', array(
                    'partenaires' => $partenaires,
        ));
    }

    /**
     * @Route("/new", name="partenaire_new")
     */
    public function newAction(Request $request) {
        $partenaire = new Partenaire();
        $form = $this->createForm('AppBundle\Form\PartenaireType', $partenaire);
        $form->handleRequest($request);
        $user = $this->getUser();
        $partenaire->setUtilisateur($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $image = $form["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire
            if ($image != NULL) {
                $partenaire->upload($image, $this->getParameter("partenaires_dir"));
            }

            $em->persist($partenaire);
            $em->flush();

            $this->addFlash("success", "Le partenaire a été ajouté avec succès");

            return $this->redirectToRoute('partenaire_index');
        }

        return $this->render('@App/Partenaire/new.html.twig', array(
                    'partenaire' => $partenaire,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="partenaire_edit")
     */
    public function editAction(Request $request, Partenaire $partenaire) {
        $editForm = $this->createForm('AppBundle\Form\PartenaireType', $partenaire);
        $editForm->handleRequest($request);
        $user = $this->getUser();
        $partenaire->setUtilisateur($user);
        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $image = $editForm["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire
            if ($image != NULL) {
                $partenaire->upload($image, $this->getParameter("partenaires_dir"));
            }
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le partenaire a été modifié avec succès");

            return $this->redirectToRoute('partenaire_index');
        }

        return $this->render('@App/Partenaire/edit.html.twig', array(
                    'partenaire' => $partenaire,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "partenaire_delete")
     */
    public function deleteAction(Request $request, Partenaire $partenaire) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le partenaire a été supprimé avec succès");
        $em->remove($partenaire);
        $em->flush();

        return $this->redirectToRoute('partenaire_index');
    }

}

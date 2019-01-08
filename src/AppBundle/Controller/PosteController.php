<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Poste;

/**
 * Poste controller.
 *
 * @Route("poste")
 */
class PosteController extends Controller {

    /**
     * @Route("/", name="poste_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $postes = $em->getRepository('AppBundle:Poste')->findby([], ["libelle" => "desc"]);

        return $this->render('@App/Poste/index.html.twig', array(
                    'postes' => $postes,
        ));
    }

    /**
     * @Route("/new", name="poste_new")
     */
    public function newAction(Request $request) {
        $poste = new Poste();
        $form = $this->createForm('AppBundle\Form\PosteType', $poste);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($poste);
            $em->flush();

            $this->addFlash("success", "Le poste a été ajouté avec succès");

            return $this->redirectToRoute('poste_index');
        }

        return $this->render('@App/Poste/new.html.twig', array(
                    'poste' => $poste,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="poste_edit")
     */
    public function editAction(Request $request, Poste $poste) {
        $editForm = $this->createForm('AppBundle\Form\PosteType', $poste);
        $editForm->handleRequest($request);
      

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le poste a été modifié avec succès");

            return $this->redirectToRoute('poste_index');
        }

        return $this->render('@App/Poste/edit.html.twig', array(
                    'poste' => $poste,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "poste_delete")
     */
    public function deleteAction(Request $request, Poste $poste) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le poste a été supprimé avec succès");
        $em->remove($poste);
        $em->flush();

        return $this->redirectToRoute('poste_index');
    }

}

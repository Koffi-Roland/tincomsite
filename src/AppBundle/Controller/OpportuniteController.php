<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Opportunite;

/**
 * Opportunite controller.
 *
 * @Route("opportunite")
 */
class OpportuniteController extends Controller {

    /**
     * @Route("/", name="opportunite_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $opportunites = $em->getRepository('AppBundle:Opportunite')->findby([], ["libelle" => "desc"]);

        return $this->render('@App/Opportunite/index.html.twig', array(
                    'opportunites' => $opportunites,
        ));
    }

    /**
     * @Route("/new", name="opportunite_new")
     */
    public function newAction(Request $request) {
        $opportunite = new Opportunite();
        $form = $this->createForm('AppBundle\Form\OpportuniteType', $opportunite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();
            $opportunite->setUtilisateur($user);
            $opportunite->setDateCreation(new \DateTime());


            $image = $form["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire
            if ($image != NULL) {
                $opportunite->upload($image, $this->getParameter("opportunite_dir"));
            }

            $em->persist($opportunite);
            $em->flush();

            $this->addFlash("success", "Le opportunite a été ajouté avec succès");

            return $this->redirectToRoute('opportunite_index');
        }

        return $this->render('@App/Opportunite/new.html.twig', array(
                    'opportunite' => $opportunite,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="opportunite_edit")
     */
    public function editAction(Request $request, Opportunite $opportunite) {
        $editForm = $this->createForm('AppBundle\Form\OpportuniteType', $opportunite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $user = $this->getUser();
            $opportunite->setUtilisateur($user);
            $opportunite->setDateCreation(new \DateTime());

            $image = $editForm["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire
            if ($image != NULL) {
                $opportunite->upload($image, $this->getParameter("opportunite_dir"));
            }

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le opportunite a été modifié avec succès");

            return $this->redirectToRoute('opportunite_index');
        }

        return $this->render('@App/Opportunite/edit.html.twig', array(
                    'opportunite' => $opportunite,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "opportunite_delete")
     */
    public function deleteAction(Request $request, Opportunite $opportunite) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le opportunite a été supprimé avec succès");
        $em->remove($opportunite);
        $em->flush();

        return $this->redirectToRoute('opportunite_index');
    }

}

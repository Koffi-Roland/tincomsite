<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\SousTypeDistributeur;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("soustypedistributeur")
 */
class SousTypeDistributeurController extends Controller {

    /**
     * @Route("/", name="soustypedistributeur_index")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $sousTypeDistributeurs = $em->getRepository("AppBundle:SousTypeDistributeur")->findAll();

        return $this->render('AppBundle:SousTypeDistributeur:index.html.twig', array(
                    "sousTypeDistributeurs" => $sousTypeDistributeurs
        ));
    }

    /**
     * @Route("/new", name="soustypedistributeur_new")
     */
    public function newAction(Request $request) {
        $sousTypeDistributeur = new SousTypeDistributeur();
        $form = $this->createForm("AppBundle\Form\SousTypeDistributeurType", $sousTypeDistributeur);

        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $image = $form["image"]->getData();

            if ($image != NULL) {
                $sousTypeDistributeur->upload($image, $this->getParameter("distributeurs_dir"));
            }
            
            $em->persist($sousTypeDistributeur);
            $em->flush();

            $this->addFlash("success", "Sous type de distributeur ajouté avec succès");

            return $this->redirectToRoute('soustypedistributeur_index');
        }

        return $this->render('AppBundle:SousTypeDistributeur:new.html.twig', array(
                    "sousTypeDistributeur" => $sousTypeDistributeur,
                    "form" => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="soustypedistributeur_edit")
     */
    public function editAction(Request $request, SousTypeDistributeur $sousTypeDistributeur) {
        $editForm = $this->createForm("AppBundle\Form\SousTypeDistributeurType", $sousTypeDistributeur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() and $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $image = $editForm["image"]->getData();

            if ($image != NULL) {
                $sousTypeDistributeur->upload($image, $this->getParameter("distributeurs_dir"));
            }
            
            $em->persist($sousTypeDistributeur);
            $em->flush();

            $this->addFlash("success", "Sous type de distributeur modifié avec succès");

            return $this->redirectToRoute('soustypedistributeur_index');
        }

        return $this->render('AppBundle:SousTypeDistributeur:edit.html.twig', array(
                    "sousTypeDistributeur" => $sousTypeDistributeur,
                    "form" => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name="soustypedistributeur_delete")
     */
    public function deleteAction(SousTypeDistributeur $sousTypeDistributeur) {
        $em = $this->getDoctrine()->getManager();

        $em->remove($sousTypeDistributeur);
        $em->flush();
        return $this->redirectToRoute('soustypedistributeur_delete');
    }

}

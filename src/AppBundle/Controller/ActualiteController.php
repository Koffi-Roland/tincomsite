<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Actualite;

/**
 * Actualite controller.
 *
 * @Route("actualite")
 */
class ActualiteController extends Controller {

    /**
     * @Route("/", name="actualite_index")
     * @Method("GET")
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('AppBundle:Actualite')->findby([], ["titre" => "desc"]);
        $paginator  = $this->get('knp_paginator');
        $actualites = $paginator->paginate(
            $actualites, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        return $this->render('@App/Actualite/index.html.twig', array(
                    'actualites' => $actualites,
        ));
    }

    /**
     * @Route("/new", name="actualite_new")
     */
    public function newAction(Request $request) {
        $actualite = new Actualite();
        $form = $this->createForm('AppBundle\Form\ActualiteType', $actualite);
        $form->handleRequest($request);
        $user = $this->getUser();
        $actualite->setUtilisateur($user);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $actualite->setDate(new \DateTime());
            $image = $form["imageFile"]->getData();
            
            $nomImage = uniqid() . "." . $image->guessExtension();
            $dossier = $this->getParameter("actualite_images_dir");
            $image->move($dossier, $nomImage);
            $actualite->setImage($nomImage);
            
            $em->persist($actualite);
            $em->flush();

            $this->addFlash("success", "L'actualite a été ajoutée avec succès");

            return $this->redirectToRoute('actualite_index');
        }

        return $this->render('@App/Actualite/new.html.twig', array(
                    'actualite' => $actualite,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="actualite_edit")
     */
    public function editAction(Request $request, Actualite $actualite) {
        $editForm = $this->createForm('AppBundle\Form\ActualiteType', $actualite);
        $editForm->get('imageFile')->isRequired(FALSE);
        $editForm->handleRequest($request);
        $user = $this->getUser();
        $actualite->setUtilisateur($user);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $actualite->setDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
        
            $actualite->setDate(new \DateTime());
            $image = $editForm["imageFile"]->getData();
            if($image != NULL){
                $nomImage = uniqid() . "." . $image->guessExtension();
                $dossier = $this->getParameter("actualite_images_dir");
                $image->move($dossier, $nomImage);
                $actualite->setImage($nomImage);
            }            
            
            $em->persist($actualite);
            $em->flush();

            $this->addFlash('success', "L'actualite a été modifié avec succès");

            return $this->redirectToRoute('actualite_index');
        }

        return $this->render('@App/Actualite/edit.html.twig', array(
                    'actualite' => $actualite,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "actualite_delete")
     */
    public function deleteAction(Request $request, Actualite $actualite) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le actualite a été supprimé avec succès");
        $em->remove($actualite);
        $em->flush();

        return $this->redirectToRoute('actualite_index');
    }

}

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Produit;

/**
 * Produit controller.
 *
 * @Route("produit")
 */
class ProduitController extends Controller {

    /**
     * @Route("/", name="produit_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('AppBundle:Produit')->findby([], ["libelle" => "desc"]);

        return $this->render('@App/Produit/index.html.twig', array(
                    'produits' => $produits,
        ));
    }

    /**
     * @Route("/new", name="produit_new")
     */
    public function newAction(Request $request) {
        $produit = new Produit();
        $form = $this->createForm('AppBundle\Form\ProduitType', $produit);
        $form->handleRequest($request);
        $user = $this->getUser();
        $produit->setUtilisateur($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $image = $form["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire
            if ($image != NULL) {
                $produit->upload($image, $this->getParameter("produits_dir"));
            }

            $em->persist($produit);
            $em->flush();

            $this->addFlash("success", "Le produit a été ajouté avec succès");

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('@App/Produit/new.html.twig', array(
                    'produit' => $produit,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="produit_edit")
     */
    public function editAction(Request $request, Produit $produit) {
        $editForm = $this->createForm('AppBundle\Form\ProduitType', $produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $user = $this->getUser();
            $produit->setUtilisateur($user);
            
            $image = $editForm["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire
            if ($image != NULL) {
                $produit->upload($image, $this->getParameter("produits_dir"));
            }

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le produit a été modifié avec succès");

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('@App/Produit/edit.html.twig', array(
                    'produit' => $produit,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "produit_delete")
     */
    public function deleteAction(Request $request, Produit $produit) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le produit a été supprimé avec succès");
        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute('produit_index');
    }

}

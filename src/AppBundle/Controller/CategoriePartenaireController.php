<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\CategoriePartenaire;

/**
 * CategoriePartenaire controller.
 *
 * @Route("categoriePartenaire")
 */
class CategoriePartenaireController extends Controller {

    /**
     * @Route("/", name="categoriePartenaire_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $categoriePartenaires = $em->getRepository('AppBundle:CategoriePartenaire')->findby([], ["libelle" => "desc"]);

        return $this->render('@App/CategoriePartenaire/index.html.twig', array(
                    'categoriePartenaires' => $categoriePartenaires,
        ));
    }

    /**
     * @Route("/new", name="categoriePartenaire_new")
     */
    public function newAction(Request $request) {
        $categoriePartenaire = new CategoriePartenaire();
        $form = $this->createForm('AppBundle\Form\CategoriePartenaireType', $categoriePartenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoriePartenaire);
            $em->flush();

            $this->addFlash("success", "Le categoriePartenaire a été ajouté avec succès");

            return $this->redirectToRoute('categoriePartenaire_index');
        }

        return $this->render('@App/CategoriePartenaire/new.html.twig', array(
                    'categoriePartenaire' => $categoriePartenaire,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="categoriePartenaire_edit")
     */
    public function editAction(Request $request, CategoriePartenaire $categoriePartenaire) {
        $editForm = $this->createForm('AppBundle\Form\CategoriePartenaireType', $categoriePartenaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le categoriePartenaire a été modifié avec succès");

            return $this->redirectToRoute('categoriePartenaire_index');
        }

        return $this->render('@App/CategoriePartenaire/edit.html.twig', array(
                    'categoriePartenaire' => $categoriePartenaire,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "categoriePartenaire_delete")
     */
    public function deleteAction(Request $request, CategoriePartenaire $categoriePartenaire) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le categoriePartenaire a été supprimé avec succès");
        $em->remove($categoriePartenaire);
        $em->flush();

        return $this->redirectToRoute('categoriePartenaire_index');
    }

}

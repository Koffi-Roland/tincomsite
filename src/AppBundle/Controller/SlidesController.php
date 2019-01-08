<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Slides;

/**
 * Slides controller.
 *
 * @Route("slide")
 */
class SlidesController extends Controller {

    /**
     * @Route("/", name="slide_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $slides = $em->getRepository('AppBundle:Slides')->findby([], ["libelle" => "desc"]);

        return $this->render('@App/Slide/index.html.twig', array(
                    'slides' => $slides,
        ));
    }

    /**
     * @Route("/new", name="slide_new")
     */
    public function newAction(Request $request) {
        $slide = new Slides();
        $form = $this->createForm('AppBundle\Form\SlidesType', $slide);
        $form->handleRequest($request);

        $user = $this->getUser();
        $slide->setUtilisateur($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $image = $form["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire
            if ($image != NULL) {
                $slide->upload($image, $this->getParameter("slides_dir"));
            }

            $em->persist($slide);
            $em->flush();

            $this->addFlash("success", "La slide a été ajouté avec succès");

            return $this->redirectToRoute('slide_index');
        }

        return $this->render('@App/Slide/new.html.twig', array(
                    'slide' => $slide,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="slide_edit")
     */
    public function editAction(Request $request, Slides $slide) {
        $editForm = $this->createForm('AppBundle\Form\SlidesType', $slide);
        $editForm->handleRequest($request);
        $user = $this->getUser();
        $slide->setUtilisateur($user);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $image = $editForm["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire
            if ($image != NULL) {
                $slide->upload($image, $this->getParameter("slides_dir"));
            }

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le slide a été modifié avec succès");

            return $this->redirectToRoute('slide_index');
        }

        return $this->render('@App/Slide/edit.html.twig', array(
                    'slide' => $slide,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "slide_delete")
     */
    public function deleteAction(Request $request, Slides $slide) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le slide a été supprimé avec succès");
        $em->remove($slide);
        $em->flush();

        return $this->redirectToRoute('slide_index');
    }

}

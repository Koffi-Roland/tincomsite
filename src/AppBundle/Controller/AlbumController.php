<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Album;

/**
 * Album controller.
 *
 * @Route("album")
 */
class AlbumController extends Controller {

    /**
     * @Route("/", name="album_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository('AppBundle:Album')->findby([], ["titre" => "asc"]);

        return $this->render('@App/Album/index.html.twig', array(
                    'albums' => $albums,
        ));
    }

    /**
     * @Route("/new", name="album_new")
     */
    public function newAction(Request $request) {
        $album = new Album();
        $form = $this->createForm('AppBundle\Form\AlbumType', $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($album);
            $em->flush();

            $this->addFlash("success", "Le album a été ajouté avec succès");

            return $this->redirectToRoute('album_index');
        }

        return $this->render('@App/Album/new.html.twig', array(
                    'album' => $album,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="album_edit")
     */
    public function editAction(Request $request, Album $album) {
        $editForm = $this->createForm('AppBundle\Form\AlbumType', $album);
        $editForm->handleRequest($request);
       
        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le album a été modifié avec succès");

            return $this->redirectToRoute('album_index');
        }

        return $this->render('@App/Album/edit.html.twig', array(
                    'album' => $album,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "album_delete")
     */
    public function deleteAction(Request $request, Album $album) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($album);
        $this->addFlash('success', "Le album a été supprimé avec succès");
        $em->flush();

        return $this->redirectToRoute('album_index');
    }

}

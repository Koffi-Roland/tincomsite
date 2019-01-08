<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Image;

/**
 * Image controller.
 *
 * @Route("image")
 */
class ImageController extends Controller {

    /**
     * @Route("/", name="image_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $images = $em->getRepository('AppBundle:Image')->findby([], ["titre" => "asc"]);

        return $this->render('@App/Image/index.html.twig', array(
                    'images' => $images,
        ));
    }

    /**
     * @Route("/new", name="image_new")
     */
    public function newAction(Request $request) {
        $images = new Image();
        $form = $this->createForm('AppBundle\Form\ImageType', $images);
        $form->handleRequest($request);
        $user = $this->getUser();
        $images->setUtilisateur($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $images->setDatePublication(new \DateTime());
            $em = $this->getDoctrine()->getManager();

            $image = $form["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire

            if ($image != NULL) {
                $i = 0;
                $images->setReference("sodigaz" . $images->getDatePublication()->format("j-m-y-h-i-s") . $i);
                $images->upload($image, $this->getParameter("images_dir"));
                $i++;
            }

            $em->persist($images);
            $em->flush();

            $this->addFlash("success", "L'image a été ajouté avec succès");

            return $this->redirectToRoute('image_index');
        }

        return $this->render('@App/Image/new.html.twig', array(
                    'images' => $images,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="image_edit")
     */
    public function editAction(Request $request, Image $image) {
        $editForm = $this->createForm('AppBundle\Form\ImageType', $image);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $user = $this->getUser();
            $image->setUtilisateur($user);
            $image->setDatePublication(new \DateTime());

            $image = $editForm["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire
            if ($image != NULL) {
                $i = 0;
                foreach ($image as $img) {
                    $image->setReference("sodigaz" . $image->getDatePublication()->format("j-m-y-h-i-s") . $i);
                    $image->upload($img, $this->getParameter("images_dir"));
                    $i++;
                    $em->persist($image);
                }
            }
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le image a été modifié avec succès");

            return $this->redirectToRoute('image_index');
        }

        return $this->render('@App/Image/edit.html.twig', array(
                    'image' => $image,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "image_delete")
     */
    public function deleteAction(Request $request, Image $image) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le image a été supprimé avec succès");
        $em->remove($image);
        $em->flush();

        return $this->redirectToRoute('image_index');
    }

}

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Conseil;

/**
 * Conseil controller.
 *
 * @Route("conseil")
 */
class ConseilController extends Controller {

    /**
     * @Route("/", name="conseil_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $conseils = $em->getRepository('AppBundle:Conseil')->findby([], ["libelle" => "desc"]);

        return $this->render('@App/Conseil/index.html.twig', array(
                    'conseils' => $conseils,
        ));
    }

    /**
     * @Route("/new", name="conseil_new")
     */
    public function newAction(Request $request) {
        $conseil = new Conseil();
        $form = $this->createForm('AppBundle\Form\ConseilType', $conseil);
        $form->handleRequest($request);
        $user = $this->getUser();
        $conseil->setUtilisateur($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $image = $form["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire
            if ($image != NULL) {
                $conseil->upload($image, $this->getParameter("conseils_dir"));
            }

            $em->persist($conseil);
            $em->flush();

            $this->addFlash("success", "Le conseil a été ajouté avec succès");

            return $this->redirectToRoute('conseil_index');
        }

        return $this->render('@App/Conseil/new.html.twig', array(
                    'conseil' => $conseil,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="conseil_edit")
     */
    public function editAction(Request $request, Conseil $conseil) {
        $editForm = $this->createForm('AppBundle\Form\ConseilType', $conseil);
        $editForm->handleRequest($request);
        $user = $this->getUser();
        $conseil->setUtilisateur($user);
        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $image = $editForm["image"]->getData();  //récupérer le champ image qui se trouve dans le formulaire
            if ($image != NULL) {
                $conseil->upload($image, $this->getParameter("conseils_dir"));
            }
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le conseil a été modifié avec succès");

            return $this->redirectToRoute('conseil_index');
        }

        return $this->render('@App/Conseil/edit.html.twig', array(
                    'conseil' => $conseil,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "conseil_delete")
     */
    public function deleteAction(Request $request, Conseil $conseil) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le conseil a été supprimé avec succès");
        $em->remove($conseil);
        $em->flush();

        return $this->redirectToRoute('conseil_index');
    }

}

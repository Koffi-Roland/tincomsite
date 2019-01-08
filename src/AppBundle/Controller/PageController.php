<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Page;
use AppBundle\Entity\Utilisateur;

/**
 * Page controller.
 *
 * @Route("page")
 */
class PageController extends Controller {

    /**
     * @Route("/", name="page_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $pages = $em->getRepository('AppBundle:Page')->findby([], ["libelle" => "desc"]);

        return $this->render('@App/Page/index.html.twig', array(
                    'pages' => $pages,
        ));
    }

    /**
     * @Route("/new", name="page_new")
     */
    public function newAction(Request $request) {
        $page = new Page();
        $form = $this->createForm('AppBundle\Form\PageType', $page);
        $form->handleRequest($request);

        $user = $this->getUser();
        $page->setUtilisateur($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            $this->addFlash("success", "La page a été ajouté avec succès");

            return $this->redirectToRoute('page_index');
        }

        return $this->render('@App/Page/new.html.twig', array(
                    'page' => $page,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="page_edit")
     */
    public function editAction(Request $request, Page $page) {
        $editForm = $this->createForm('AppBundle\Form\PageType', $page);
        $editForm->handleRequest($request);

        $user = $this->getUser();
        $page->setUtilisateur($user);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le page a été modifié avec succès");

            return $this->redirectToRoute('page_index');
        }

        return $this->render('@App/Page/edit.html.twig', array(
                    'page' => $page,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "page_delete")
     */
    public function deleteAction(Request $request, Page $page) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le page a été supprimé avec succès");
        $em->remove($page);
        $em->flush();

        return $this->redirectToRoute('page_index');
    }

}

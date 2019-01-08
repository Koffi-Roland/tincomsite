<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CategorieProduit;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {
        return $this->render('@Site/default/index.html.twig');
    }

    /**
     * @Route("/produits", name="produits_page")
     */
    public function produitAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $categorieProduits = $em->getRepository('AppBundle:CategorieProduit')->findAll([]);
        $selectedCategorieProduit = $em->getRepository('AppBundle:CategorieProduit')->findOneBy([]);
        $produits = $em->getRepository('AppBundle:Produit')->findByCategorieProduit($selectedCategorieProduit);
        
        $paginator  = $this->get('knp_paginator');
        $produits = $paginator->paginate(
            $produits, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9/*limit par page*/
        );
        
        return $this->render('@Site/default/produits.html.twig', array(
                'categorieProduits' => $categorieProduits,
                'selectedCategorieProduit' => $selectedCategorieProduit,
                'produits' => $produits,
            ));
    }

    /**
     * @Route("/produits/{selectedCategorieProduit}", name="produits_categorie_page")
     */
    public function produitParCategorieAction(CategorieProduit $selectedCategorieProduit, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $categorieProduits = $em->getRepository('AppBundle:CategorieProduit')->findAll([]);
        $produits = $em->getRepository('AppBundle:Produit')->findByCategorieProduit($selectedCategorieProduit);
        
        $paginator  = $this->get('knp_paginator');
        $produits = $paginator->paginate(
            $produits, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9/*limit per page*/
        );
        
        return $this->render('@Site/default/produits.html.twig', array(
                'categorieProduits' => $categorieProduits,
                'selectedCategorieProduit' => $selectedCategorieProduit,
                'produits' => $produits,
            ));
    }

    /**
     * @Route("/page/{slug}", name="display_page")
     */
    public function pageAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $page  = $em->getRepository("AppBundle:Page")->findOneBySlug($slug);
        
        return $this->render('@Site/default/page.html.twig', array('page' => $page));
    }

}

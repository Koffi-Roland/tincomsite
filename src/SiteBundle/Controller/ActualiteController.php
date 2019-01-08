<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Actualite;
use AppBundle\Entity\CategorieActualite;
use Symfony\Component\HttpFoundation\Request;

class ActualiteController extends Controller {

    /**
     * @Route("/actualites", name="actualite_sodigaz")
     */
    public function actualiteAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $actualites = $em->getRepository("AppBundle:Actualite")->findBy([], ["date" => "desc"]);
        $categorieActualites = $em->getRepository("AppBundle:CategorieActualite")->findAll();
        
        $paginator  = $this->get('knp_paginator');
        $actualites = $paginator->paginate(
            $actualites, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );
        
        return $this->render('@Site/actualite/actualite.html.twig', array(
            'categorieActualites' => $categorieActualites,
            'actualites' => $actualites,
            ));
    }
    
    /**
     * @Route("/actualites/{slug}", name="actualite_display_sodigaz")
     */
    public function afficherActualiteAction($slug) {
        $em = $this->getDoctrine()->getManager();
        
        $actualite = $em->getRepository("AppBundle:Actualite")->findOneBySlug($slug);
        
        $actualites = $em->getRepository("AppBundle:Actualite")->findBy([], ["date" => "desc"]);
        $categorieActualites = $em->getRepository("AppBundle:CategorieActualite")->findAll();
        
        $query = $em->createQuery("select a " .
                 "from AppBundle:Actualite a " .
                 "where a.id <> :id " .
                  "order by a.date desc"
                )
                ->setParameter("id", $actualite->getId());
        $paginator  = $this->get('knp_paginator');
        //les dernières actualités publiées
        $autres = $paginator->paginate(
            $query, /* query NOT result */
            1/*page number*/,
            5/*limit per page*/
        );
        //dump($autres); exit;
        return $this->render('@Site/actualite/actualite_display.html.twig', array(
            'actualite' => $actualite,
            "categorieActualites" => $categorieActualites,
            "autres" => $autres,
            ));
    }

    /**
     * @Route("/actualite/{selectedCategorieActualite}/categorie", name="actualite_categorie_sodigaz")
     */
    public function actualiteParCategorieAction(CategorieActualite $selectedCategorieActualite, Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        
        $actualites = $em->createQuery( "select a " .
                                        " from AppBundle:Actualite a " .
                                        " join a.categorieActualite cat" .
                                        " where :ca = cat"
                                    )
                                    ->setParameter("ca", $selectedCategorieActualite)
                                    ->getResult();
        
        $categorieActualites = $em->getRepository("AppBundle:CategorieActualite")->findAll();
        
        $paginator  = $this->get('knp_paginator');
        $actualites = $paginator->paginate(
            $actualites, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );
        
        return $this->render('@Site/actualite/actualite_categorie.html.twig', array(
            'categorieActualites' => $categorieActualites,
            "actualites" => $actualites,
            'selectedCategorieActualite' => $selectedCategorieActualite,
            ));
    }

}
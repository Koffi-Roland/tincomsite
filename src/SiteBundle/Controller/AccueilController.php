<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AccueilController extends Controller {

    /**
     * @Route("/", name="accueil_sodigaz")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $slides = $em->getRepository('AppBundle:Slides')->findby([], ["libelle" => "desc"]);

        $partenaires = $em->getRepository('AppBundle:Partenaire')->findby([], ["nom" => "asc"]);

        $images = $em->getRepository('AppBundle:Image')->findby([], ["titre" => "desc"]);

        $id = 1;
        foreach ($images as $image) {
            $img = $em->getRepository('AppBundle:Image')->findOneBy(["id" => $id], ["id" => "asc"]);
            $id++;
        }
        $imager = $em->getRepository('AppBundle:Image')->findby(["album" => $img->getAlbum()], ["titre" => "desc"]);

//        dump($imager);
//        exit();
//
//        $categoriePartenaires = $em->getRepository('AppBundle:CategoriePartenaire')->findby([], ["libelle" => "desc"]);
//
//        $partenaires = [];
//
//        foreach ($categoriePartenaires as $categoriePartenaire) {
//            $partenaires[] = $em->getRepository('AppBundle:Partenaire')->findBy(["categoriePartenaire" => $categoriePartenaire], ["nom" => "asc"]);
//        }
//        dump($categoriePartenaires);
//        exit();
//        dump($img->getAlbum()->getTitre());
//        exit();


        $actualites = $em->getRepository("AppBundle:Actualite")->findBy([], ["date" => "desc"]);

        $paginator = $this->get('knp_paginator');
        $actualites = $paginator->paginate(
                $actualites, /* query NOT result */ 1/* page number */, 4/* limit per page */
        );

        return $this->render('@Site/accueil/index.html.twig', array(
                    'slides' => $slides,
                    'partenaires' => $partenaires,
                    "img" => $img,
                    'imager' => $imager,
                    'actualites' => $actualites,
        ));
    }

}

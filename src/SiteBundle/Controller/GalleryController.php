<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Album;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends Controller {

    /**
     * @Route("/gallery", name="gallery_sodigaz")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $images = $em->getRepository('AppBundle:Image')->findby([], ["titre" => "desc"]);

        return $this->render('@Site/gallery/index.html.twig', array(
                    'images' => $images,
        ));
    }

    /**
     * @Route("/images", name="images_page")
     */
    public function ImageAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $albums = $em->getRepository('AppBundle:Album')->findAll([]);
        $selectedAlbum = $em->getRepository('AppBundle:Album')->findOneBy([]);
        $images = $em->getRepository('AppBundle:Image')->findByAlbum($selectedAlbum);
        $imager = $em->getRepository('AppBundle:Image')->findAll([], ["titre" => "asc"]);

        $paginator = $this->get('knp_paginator');
        $images = $paginator->paginate(
                $images, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 9/* limit par page */
        );

        return $this->render('@Site/gallery/index.html.twig', array(
                    'albums' => $albums,
                    'selectedAlbum' => $selectedAlbum,
                    'images' => $images,
                    'imager' => $imager,
        ));
    }

    /**
     * @Route("/images/{selectedAlbum}", name="images_album_page")
     */
    public function imageParAlbumAction(Album $selectedAlbum, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $albums = $em->getRepository('AppBundle:Album')->findAll([]);
        $images = $em->getRepository('AppBundle:Image')->findByAlbum($selectedAlbum);

        $paginator = $this->get('knp_paginator');
        $images = $paginator->paginate(
                $images, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 9/* limit per page */
        );

        return $this->render('@Site/gallery/index.html.twig', array(
                    'albums' => $albums,
                    'selectedAlbum' => $selectedAlbum,
                    'images' => $images,
        ));
    }

}

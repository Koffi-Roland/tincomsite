<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProduitServicesController extends Controller {

    /**
     * @Route("/Produit",name="produit_sodigaz")
     */
    public function ProduitAction() {
        return $this->render('@Site/produitServices/produit.html.twig');
    }

    /**
     * @Route("/Service",name="service_sodigaz")
     */
    public function ServiceAction() {
        return $this->render('@Site/produitServices/service.html.twig');
    }

}

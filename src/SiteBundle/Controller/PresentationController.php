<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PresentationController extends Controller {

    /**
     * @Route("/index")
     */
    public function indexAction() {
        return $this->render('Site/presentation/index.html.twig');
    }

    /**
     * @Route("/Histoire",name="histoire_sodigaz")
     */
    public function HistoireAction() {
        return $this->render('@Site/presentation/histoire.html.twig');
    }

    /**
     * @Route("/Activite",name="activite_sodigaz")
     */
    public function ActiviteAction() {
        return $this->render('@Site/presentation/activite.html.twig');
    }

    /**
     * @Route("/Objectif",name="objectif_sodigaz")
     */
    public function ObjectifAction() {
        return $this->render('@Site/presentation/objectif.html.twig');
    }

}

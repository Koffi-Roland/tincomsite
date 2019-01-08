<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class OpportuniteController extends Controller {

    /**
     * @Route("/Opportunite", name="opportunite_sodigaz")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $postes = $em->getRepository('AppBundle:Poste')->findby([], ["libelle" => "desc"]);
        $typeOpportunites = $em->getRepository('AppBundle:TypeOpportunite')->findby([], ["libelle" => "desc"]);
        $opportunites = $em->getRepository('AppBundle:Opportunite')->findby([], ["libelle" => "desc"]);

        return $this->render('@Site/opportunite/opportunite.html.twig', array(
                    'postes' => $postes,
                    'typeOpportunites' => $typeOpportunites,
                    'opportunites' => $opportunites,
        ));
    }

}

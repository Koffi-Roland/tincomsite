<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ConseilController extends Controller {

    /**
     * @Route("/conseil", name="conseil_sodigaz")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $conseils = $em->getRepository('AppBundle:Conseil')->findby([], ["libelle" => "desc"]);

        return $this->render('@Site/Conseil/index.html.twig', array(
                    'conseils' => $conseils,
        ));
    }

}

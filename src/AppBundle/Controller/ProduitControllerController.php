<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProduitControllerController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:ProduitController:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/new")
     */
    public function newAction()
    {
        return $this->render('AppBundle:ProduitController:new.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/edit")
     */
    public function editAction()
    {
        return $this->render('AppBundle:ProduitController:edit.html.twig', array(
            // ...
        ));
    }

}

<?php

namespace SiteBundle\Service;

use Doctrine\ORM\EntityManagerInterface;

class Vglobal {
    
    private $em;
    
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }
    
    public function pageHistoire(){
        $categories = $this->em->getRepository("AppBundle:Page")->find(1);
        return $categories;
    }
    
    public function pageActivite(){
        $categories = $this->em->getRepository("AppBundle:Page")->find(2);
        return $categories;
    }
    
    public function pageObjectif(){
        $categories = $this->em->getRepository("AppBundle:Page")->find(3);
        return $categories;
    }
    
    public function getMenuArbre() {
        $menuArbre = $this->em->getRepository("AppBundle:Menu")->getMenuArbre();
        return $menuArbre;
    }
}
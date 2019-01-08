<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Menu;

/**
 * @Route("menu")
 */
class MenuController extends Controller {

    /**
     * @Route("/index", name="menu_index")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $pages = $em->getRepository('AppBundle:Page')->findAll();
        $menus = $em->getRepository('AppBundle:Menu')->findAll();
        $parents = $em->getRepository('AppBundle:Menu')->findAll();

        return $this->render('AppBundle:Menu:index.html.twig', array(
                    "pages" => $pages,
                    "menus" => $menus,
                    "parents" => $parents,
        ));
    }

    /**
     * @Route("/liste/fils", name="menu_fils")
     */
    public function listerFilsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $parent_id = $request->query->get("id");

        $query = 'select f ' .
                'from AppBundle:Menu f ';

        $jsonResponse = new JsonResponse();
        $fils = null;
        if ($parent_id == 0) {
            $fils = $em->createQuery($query .
                            'where f.parent is null ' .
                            'order by f.position asc'
                    )
                    ->getScalarResult();
        } else {
            $fils = $em->createQuery($query .
                            'join f.parent p ' .
                            'where p.id = :id ' .
                            'order by f.position asc'
                    )
                    ->setParameter('id', $parent_id)
                    ->getScalarResult();
        }



        return $jsonResponse->setData($fils);
    }

    /**
     * @Route("/ajouter/", name="menu_new")
     * @method("POST")
     */
    public function addMenuAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $menu = new Menu();

        $parent_id = $request->request->get('parent');
        $avant = $request->request->get('avant');
        $type = $request->request->get('type');
        $menu_url = "#";
        //dump($type); exit;
        switch ($type) {
            case "accueil":
                $menu_url = $this->generateUrl('accueil_sodigaz');
                $menu->setTitre("Accueil");
                break;
            case "page":
                $slug = $request->request->get('page');
                $page = $em->getRepository('AppBundle:Page')->findOneBySlug($slug);
                $menu_url = $this->generateUrl('display_page', array('slug' => $slug));
                $menu->setTitre($page->getLibelle());
                break;
            case "actualite":
                $menu_url = $this->generateUrl('actualite_sodigaz');
                $menu->setTitre("Actualités");
                break;
            case "produits":
                $menu_url = $this->generateUrl('produits_page');
                $menu->setTitre("Produits");
                break;
            case "lien":
                $menu_url = $request->request->get("url");
                $menu->setTitre($request->request->get("titre"));
                break;
            default:
                throw $this->createNotFoundException("page introuvable");
                break;
        }
        $menu->setLien($menu_url);
        if ($parent_id == 0) {
            $menu->setParent(NULL);
        } else {
            $parent = $em->getRepository('AppBundle:Menu')->find($parent_id);
            $menu->setParent($parent);
        }
        if ($avant == 0) {
            $this->putLast($menu);
        } else {
            $mAvant = $em->getRepository('AppBundle:Menu')->find($avant);
            $pos = $mAvant->getPosition();
            $menu->setPosition($pos);
            $this->positionner($mAvant, $pos + 1);
        }
        $em->persist($menu);
        $em->flush();

        $this->addFlash("success", "Menu ajouté avec succès");

        return $this->redirectToRoute('menu_index');
    }

    function positionner($menu, $position) {
        $em = $this->getDoctrine()->getManager();
        $menu->setPosition($position);

        $suivant = $em->getRepository('AppBundle:Menu')->findOneBy(["position" => $position, "parent" => $menu->getParent()]);
        if ($suivant != NULL) {
            $this->positionner($suivant, $position + 1);
            $em->persist($suivant);
        }
        $em->persist($menu);
        $em->flush();
    }

    public function putLast($menu) {
        $em = $this->getDoctrine()->getManager();
        $max = 0;
        if ($menu->getParent() == NULL) {
            $max = $em->createQuery('select max(m.position) ' .
                            'from AppBundle:Menu m ' .
                            'where m.parent is null'
                    )
                    ->getSingleScalarResult();
        } else {
            $max = $em->createQuery('select max(m.position) ' .
                            'from AppBundle:Menu m ' .
                            'join m.parent p ' .
                            'where p.id = :id'
                    )
                    ->setParameter('id', $menu->getParent()->getId())
                    ->getSingleScalarResult();
        }
        $max = $max == NULL ? 0 : $max;
        $menu->setPosition($max + 1);
    }

    /**
     * @Route("/delete/{id}", name="menu_delete")
     * @method("POST")
     */
    function deleteAction(Menu $menu) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($menu);
        $em->flush();
        $this->addFlash("success", "Menu supprimé avec succès");
        return $this->redirectToRoute('menu_index');
    }

}

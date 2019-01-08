<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Contact;

class ContactController extends Controller {

    /**
     * @Route("/contact", name="contact_sodigaz")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        
        $typeDistributeurs = $em->getRepository('AppBundle:TypeDistributeur')->findAll();
        
        $distributeurs = $em->getRepository('AppBundle:Distributeur')->findAll();
        
        $distributeurs_array = [];
        
        foreach ($distributeurs as $distributeur) {
            $distributeurs_array[$distributeur->getSousTypeDistributeur()->getId()][] = $distributeur;
        }
        
        return $this->render('@Site/contact/index.html.twig', array(
            "typeDistibuteurs" => $typeDistributeurs,
            "distributeurs_array" => $distributeurs_array,
            "distributeurs" => $distributeurs,
        ));
    }
    
    /**
     * @Route("/sendMail",
     *     options = { "expose" = true },
     *     name = "contact_send_mail",
     * )
     */
    public function sendAction(Request $request) {
        
        if($request->isMethod("POST")){
            
            $name = $request->request->get("name");
            $email = $request->request->get("email");
            $subject = $request->request->get("subject");
            $mess = $request->request->get("message");
            
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('AppBundle:Utilisateur')->findAll();
            $emails = [];
            foreach ($users as $user) {
                $emails[] = $user->getEmail(); 
            }
            
            $message = (new \Swift_Message())
                        ->setFrom($email)
                        ->setTo($emails)
                        ->setBody(
                            $this->renderView(
                                'SiteBundle:contact:email.html.twig',
                                array('message' => $mess, 'nom' => $name)
                            ),
                            'text/html'
                        );
            $mailer = $this->get('mailer');
            $mailer->send($message);
            
            $contact = new Contact();
            $contact->setNom($name);
            $contact->setEmail($email);
            $contact->setSujet($subject);
            $contact->setMessage($mess);
            
            $em->persist($contact);
            $em->flush();
            
            echo 'OK';
            exit;
        }
        
    }
}

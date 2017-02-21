<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class InscriptionController extends Controller
{

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscriptionAction(\Symfony\Component\HttpFoundation\Request $req)
    {
        $dto = new \AppBundle\DTO\InscriptionDTO(); // crée un DTO
        $form = $this->createForm(\AppBundle\Form\InscriptionType::class, $dto); // crée le formulaire
        $form->handleRequest($req); // applique le form binding

        if ($form->isSubmitted() && $form->isValid())
        {
            // ajout de l'utilisateur en BDD
             $client = new \AppBundle\Entity\Client();
             $client->setLogin($dto->getLogin());
             $client->setMdp($dto->getMdp1());
             
            $em = $this->getDoctrine()->getManager();
            $em->persist($client); // requete d'insertion sql
            $em->flush();
            
            return  $this->render("::message.html.twig", array("message" => "inscription réussie"));
        }

        // ici le formulaire n'a pas été posté ou est invalide
        return $this->render("AppBundle:Inscription:inscription.html.twig", array("monForm" => $form->createView()));
    }
    

}

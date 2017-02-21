<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormController extends Controller
{

    /**
     * @Route("/filtres", name="filtres")
     */
    public function filtresAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $dto = new \AppBundle\DTO\FiltresDTO();
//        $dto->setDateCreation( new \DateTime());
        $form = $this->createForm(\AppBundle\Form\FiltresType::class, $dto);
        $form->handleRequest($request); // applique le form binding
//        $produits = "";

        $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
//        $qb = new \Doctrine\ORM\QueryBuilder();
        $qb->select("p")
                ->from("AppBundle:Produit", "p")
                ->join("p.commandes", "cmd")
                ->join("cmd.client", "cl")
                ->orderBy("p.titre");

        if ($form->isSubmitted() && $form->isValid())
        {

            $client = $dto->getClient();
            $dateDebut = $dto->getDateDebut();
            $dateFin = $dto->getDateFin();

            if ($client != NULL)
            {
                $qb->andwhere("cl = :client ");
                $qb->setParameter("client", $client);
            }
            if ($dateDebut != NULL)
            {
                $qb->andWhere("cmd.dateheureCreation >= :dateDebut ");
                $qb->setParameter("dateDebut", $dateDebut);
            }
            if ($dateFin != NULL)
            {
                $qb->andWhere("cmd.dateheureCreation <= :dateFin ");
                $qb->setParameter("dateFin", $dateFin);
            }
        }

        $produits = $qb->getQuery()->getResult();

        return $this->render('AppBundle:Form:filtres.html.twig', array(
                    "monFormulaire" => $form->createView(),
                    "mesProduits" => $produits
        ));
    }

}

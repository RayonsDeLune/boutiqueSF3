<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class QueryBuilderController extends Controller
{
    /**
     * @Route("/qb", name="qb")
     */
    public function qbAction()
    {
        $qb=$this->getDoctrine()->getManager()->createQueryBuilder();
//        $qb = new \Doctrine\ORM\QueryBuilder();
        $qb->select("c");
        $qb->from("AppBundle:Produit","c");
        $qb->join("c.commandes", "cmd");
        $qb->join("cmd.client", "cl");
        $qb->where("cl.login LIKE :login");
        $qb->andWhere("c.prix BETWEEN :min AND :max ");
        
        $res = $qb->getQuery();
         $res->setParameter("login","%Wars%");
        $res->setParameter("min","0");
        $res->setParameter("max","50000");
        $produits = $res->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits'));
    }
}



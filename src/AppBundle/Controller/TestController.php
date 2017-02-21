<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller
{
    
    /**
     * @Route("/rechercher_produit_titre_desc", name="rechercher_produit_titre_desc")
     */
    public function rechercherProduitParTitreOuDescAction(){
        
        // récup les produits par cat_id en bdd
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT p FROM AppBundle:Produit p "
                . "WHERE p.titre LIKE :monTitre "
                . "OR  p.description LIKE :description "
                . " ORDER BY p.titre ";
        $res = $em->createQuery($req);
        $res->setParameter("monTitre","%m%");
        $res->setParameter("description","%t%");
        $produits = $res->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits'));
    }
    
    // 5 - les produits commandés par :login dont le prix est entre :min et :max
     /**
     * @Route("/lister_produits_commandes_par_login", name="lister_produits_commandes_par_login")
     */
    public function listerProduitsCommandesParLoginAction()
    {
        // Récup ts produits en DB
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT p FROM AppBundle:Produit p "
                . "JOIN p.commandes cmd "
                . "     JOIN cmd.client cl"
                . "     WHERE cl.login=:login  "
                . "AND p.prix between :min AND :max "
                . "ORDER BY p.titre ";
        $res = $em->createQuery($req);
        $res->setParameter("login","Wars");
        $res->setParameter("min","0");
        $res->setParameter("max","50000");
        $produits = $res->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits commandés par Florence'));
    }
    
    /**
     * @Route("/lister_produits_pagination", name="lister_produits_pagination")
     */
    public function listerProduitsPaginationAction(){
        
        // Récup ts produits en DB
        $produitsRepo = $this->getDoctrine()->getManager()->createQuery("SELECT p FROM AppBundle:Produit p ORDER BY p.titre ");
        $produitsRepo->setFirstResult(5);
        $produitsRepo->setMaxResults(2);
        $produits=$produitsRepo->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits'));
    }
    
    
    
    /**
     * @Route("/lister_produits", name="lister_produits")
     */
    public function listerProduitsAction(){
        
        // Récup ts produits en DB
        $produitsRepo = $this->getDoctrine()->getRepository("AppBundle:Produit");
        $produits = $produitsRepo->findAll();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits'));
    }
    
    /**
     * @Route("/lister_produits_par_cat_id", name="lister_produits_par_cat")
     */
    public function prodParCatAction(){
        
        // récup les produits par cat_id en bdd
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT p FROM AppBundle:Produit p JOIN p.categories c WHERE c.id=1 ORDER BY p.titre ";
        $produits = $em->createQuery($req)->getResult();
        
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits de la catégorie 1'));
    }
    
    /**
     * @Route("/lister_commandes_par_client", name="lister_commandes_par_client")
     */
    public function listerCommandesParClientAction()
    {
        // récup les produits par cat_id en bdd
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT c, cl FROM AppBundle:Commande c "
                . "JOIN c.client cl "
                . "JOIN c.produits p "
                . "WHERE cl.id=1  "
                . "AND p.id=1 ";
        $commandes = $em->createQuery($req)->getResult();
        
        return $this->render('AppBundle:Test:lister_commandes_par_client.html.twig', array('mesCommandes'=>$commandes ));
    }
    
    /**
     * @Route("/lister_produits_100_5000", name="lister_produits_100_5000")
     */
    public function listerProduits100_5000Action()
    {
        // Récup ts produits en DB
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT p FROM AppBundle:Produit p "
                . "WHERE p.prix BETWEEN 100 AND 5000  "
                . "ORDER BY p.prix ";
        $produits = $em->createQuery($req)->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits'));
    }
    
    // 2 - tous les produits dont l'id est 1, 2, ou 3 (IN)
    /**
     * @Route("/lister_produits_1_2_3", name="lister_produits_1_2_3")
     */
    public function listerProduits1_2_3Action()
    {
        // Récup ts produits en DB
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT p FROM AppBundle:Produit p "
                . "WHERE p.id IN (1,2,3)  "
                . "ORDER BY p.prix ";
        $produits = $em->createQuery($req)->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits'));
    }
    
    // 3 - les commandes passées par Antoine
    /**
     * @Route("/lister_commandes_Antoine", name="lister_commandes_Antoine")
     */
    public function lister_commandes_AntoineAction()
    {
        // récup les produits par cat_id en bdd
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT c FROM AppBundle:Commande c "
                . "JOIN c.client cl "
                . "JOIN c.produits p "
                . "WHERE cl.login='Antoine'  ";
        $commandes = $em->createQuery($req)->getResult();
        
        return $this->render('AppBundle:Test:lister_commandes_par_client.html.twig', array('mesCommandes'=>$commandes ));
    }
    
     // 4 - les commandes passées par Wars dans l'ordre chronologique
     /**
     * @Route("/lister_commandes_Wars", name="lister_commandes_Wars")
     */
    public function lister_commandes_WarsAction()
    {
        // récup les produits par cat_id en bdd
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT c FROM AppBundle:Commande c "
                . "JOIN c.client cl "
                . "JOIN c.produits p "
                . "WHERE cl.login='Wars' "
                . "ORDER BY c.dateheureCreation ";
        $commandes = $em->createQuery($req)->getResult();
        
        return $this->render('AppBundle:Test:lister_commandes_par_client.html.twig', array('mesCommandes'=>$commandes ));
    } 
     
     // 5 - les produits commandés par Florence dans l'ordre Alpha
     /**
     * @Route("/lister_produits_commandes_par_Flo", name="lister_produits_commandes_par_Flo")
     */
    public function listerProduitsCommandesParFloAction()
    {
        // Récup ts produits en DB
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT p FROM AppBundle:Produit p "
                . "JOIN p.commandes cmd "
                . "     JOIN cmd.client cl"
                . "     WHERE cl.login='Florence'  "
                . "ORDER BY p.titre ";
        $produits = $em->createQuery($req)->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits commandés par Florence'));
    }
    
    // 6. Les commandes comprenant un pelle
     /**
     * @Route("/lister_commandes_pelle", name="lister_commandes_pelle")
     */
    public function lister_commandes_pelleAction()
    {
        // récup les commandes où il y a une pelle
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT c FROM AppBundle:Commande c "
                . "JOIN c.client cl "
                . "JOIN c.produits p "
                . "WHERE p.titre='Pelle' "
                . "ORDER BY c.dateheureCreation ";
        $commandes = $em->createQuery($req)->getResult();
        
        return $this->render('AppBundle:Test:lister_commandes_par_client.html.twig', array('mesCommandes'=>$commandes ));
    } 
    
    // 7. Les produits ayant fait l'objet d'une commande
    /**
     * @Route("/lister_produits_commandes", name="lister_produits_commandes")
     */
    public function listerProduitsCommandesAction()
    {
        // Récup ts produits en DB
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT p FROM AppBundle:Produit p "
                . "JOIN p.commandes cmd "
                . "     JOIN cmd.client cl "
                . "ORDER BY p.titre ";
        $produits = $em->createQuery($req)->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits commandés'));
    }
    
    // 8. Les produits n'ayant pas fait l'objet d'une commande
    /**
     * @Route("/lister_produits_non_commandes", name="lister_produits_non_commandes")
     */
    public function listerProduitsNonCommandesAction()
    {
        // Récup ts produits en DB
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT p1 FROM AppBundle:Produit p1"
                . " WHERE p1 NOT IN ( SELECT p FROM AppBundle:Produit p "
                . "         JOIN p.commandes cmd "
                . "         JOIN cmd.client cl ) "
                . "ORDER BY p1.titre ";
        $produits = $em->createQuery($req)->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits non commandés'));
    }
    
    // 9. Les produits ayant fait l'objet d'une commande de la part de Florence,
    //          qui n'ont pas fait l'objet d'une commande de Trump
     /**
     * @Route("/lister_produits_commandes_par_Flo_et_pas_par_Trump", name="lister_produits_commandes_par_Flo_et_pas_par_Trump")
     */
    public function listerProduitsCommandesParFloEtPasParTrumpAction()
    {
        // Récup ts produits en DB
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT p FROM AppBundle:Produit p "
                . "JOIN p.commandes cmd "
                . "     JOIN cmd.client cl"
                . "     WHERE cl.login='Florence'  "
                . " AND p NOT IN ("
                . "     SELECT p1 FROM AppBundle:Produit p1 "
                . "             JOIN p1.commandes cmd1 "
                . "             JOIN cmd1.client cl1"
                . "             WHERE cl1.login='Trump' ) "
                . "ORDER BY p.titre ";
        $produits = $em->createQuery($req)->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Liste des produits commandés par Florence et pas par Trump'));
    }
    
    // 10. Le nom de chaque produit, et le nombre de fois qu'ils ont été commandés
    //          (GROUP BY), classés par ordre alpha
    /**
     * @Route("/lister_produits_nb_commandes", name="lister_produits_nb_commandes")
     */
    public function listerProduitsNbCommandesAction()
    {
        // Récup ts produits en DB
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT p.titre, p.prix, count(cmd) nbCommandes FROM AppBundle:Produit p "
                . " LEFT JOIN p.commandes cmd "
                . " GROUP BY p.id "
                . " ORDER BY nbCommandes DESC, p.titre ";
        $produits = $em->createQuery($req)->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits_commandes.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Pour chaque produit le nb de fois où ils ont été commandés'));
    }
    
    // 11. Idem que 10, uniquement si ils ont été commandés au moins 2 x
    /**
     * @Route("/lister_produits_nb_commandes_sup_1", name="lister_produits_nb_commandes_sup_1")
     */
    public function listerProduitsNbCommandesSup1Action()
    {
        // Récup ts produits en DB
        $em = $this->getDoctrine()->getManager();
        $req = "SELECT p.titre, p.prix, count(cmd) nbCommandes FROM AppBundle:Produit p "
                . " JOIN p.commandes cmd "
                . " GROUP BY p.id "
                . " HAVING nbCommandes>1 "
                . " ORDER BY nbCommandes DESC, p.titre ";
        $produits = $em->createQuery($req)->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits_commandes.html.twig",
                array('mesProduits'=>$produits, 'titre'=>'Pour chaque produit le nb de fois où ils ont été commandés'));
    }
    
    /**
     * @Route("/lister_tous_clients", name="lister_clients")
     */
    public function listerClientsAction()
    {
        return $this->render('AppBundle:Test:lister_tous_clients.html.twig', array(
            // ...
        ));
    }

}

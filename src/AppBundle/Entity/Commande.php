<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="commandes")
     */
    private $produits;
    
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="commandes")
     * @ORM\JoinColumn(name="client_id")
     */
    private $client;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateheureCreation", type="datetime")
     */
    private $dateheureCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=16)
     */
    private $etat;

    /**
     * @var float
     *
     * @ORM\Column(name="prixTotal", type="float")
     */
    private $prixTotal;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateheureCreation
     *
     * @param \DateTime $dateheureCreation
     *
     * @return Commande
     */
    public function setDateheureCreation($dateheureCreation)
    {
        $this->dateheureCreation = $dateheureCreation;

        return $this;
    }

    /**
     * Get dateheureCreation
     *
     * @return \DateTime
     */
    public function getDateheureCreation()
    {
        return $this->dateheureCreation;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Commande
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set prixTotal
     *
     * @param float $prixTotal
     *
     * @return Commande
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return float
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Commande
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add produit
     *
     * @param \AppBundle\Entity\Produit $produit
     *
     * @return Commande
     */
    public function addProduit(\AppBundle\Entity\Produit $produit)
    {
        $this->produits[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \AppBundle\Entity\Produit $produit
     */
    public function removeProduit(\AppBundle\Entity\Produit $produit)
    {
        $this->produits->removeElement($produit);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduits()
    {
        return $this->produits;
    }
    
    public function __toString() {
        return "Commande: " . $this->id;
    }
}

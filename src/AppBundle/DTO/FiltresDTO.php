<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\DTO;

use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Expression;

/**
 * Description of ProduitDTO
 * @author Hélène 
 */
class FiltresDTO
{

    /**
     *
     * @NotBlank(message="Le client ne peut être vide.")
     */
    private $client;
    private $dateDebut;
    private $dateFin;

    function getClient()
    {
        return $this->client;
    }

    function getDateDebut()
    {
        return $this->dateDebut;
    }

    function getDateFin()
    {
        return $this->dateFin;
    }

    function setClient($client)
    {
        $this->client = $client;
    }

    function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @Callback()
     */
    public function maCallBack(\Symfony\Component\Validator\Context\ExecutionContextInterface $context, $payload)
    {
        if ($this->dateDebut > $this->dateFin)
        {
            $context->buildViolation("La date de début ne peut pas être supérieure à la date de fin.")->addViolation();
        }
        if ($this->dateDebut == NULL && $this->dateFin == NULL && $this->client == NULL)
        {
            $context->buildViolation("Un des champs doit être rempli.")->addViolation();
        }
    }

}

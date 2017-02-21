<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\DTO;


/**
 * Description of InscriptionDTO
 *
 * @author Hélène
 */
class InscriptionDTO {
   private $login;
   private $mdp1;
   private $mdp2;
   
   function getLogin() {
       return $this->login;
   }

   function getMdp1() {
       return $this->mdp1;
   }

   function getMdp2() {
       return $this->mdp2;
   }

   function setLogin($login) {
       $this->login = $login;
   }

   function setMdp1($mdp1) {
       $this->mdp1 = $mdp1;
   }

   function setMdp2($mdp2) {
       $this->mdp2 = $mdp2;
   }


}

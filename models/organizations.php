<?php
require_once 'database.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of services
 *
 * @author ngougane
 */
class organizations {
  
   private $db;
   public $id = 0;
   public $jobTitle = '';
   public $service = ''; 
   public $phoneNumberOffice = ''; 
   public $idUsers="";
   public $idCommunity = ''; 
   
      /**
 * Méthode magique construct contient l'appel à la database ( singleton ) et sa méthode getInstance() 
 * Elle permet d'instancié l'objet dans l'instance à la base de donnée courante. 
 */
   public function __construct() {
      try {
         $this->db= database::getInstance();
      } catch (Exception $ex) {
         die('Erreur : ' . $ex->getMessage());
      }
   }
        
   public function createService() {
      $query = 'INSERT INTO `CDM25PR_Organization`(`jobTitle`, `service`, `phoneNumberOffice`, `idUsers`, `idCommunity`)  '
                 . 'VALUES (:jobTitle ,:service ,:phoneNumberOffice ,:idUsers ,:idCommunity)';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':jobTitle', $this->jobTitle, PDO::PARAM_STR);
      $queryExecute->bindValue(':service', $this->service, PDO::PARAM_STR);
      $queryExecute->bindValue(':phoneNumberOffice', $this->phoneNumberOffice, PDO::PARAM_STR);
           $queryExecute->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
      $queryExecute->bindValue(':idCommunity', $this->idCommunity, PDO::PARAM_INT);
      if(!$queryExecute->execute()){
         throw new Exception();
      }
   }

   public function commit(){
      return $this->db->commit();
   }
   
      public function rollback(){
      return $this->db->rollback();
   }
}

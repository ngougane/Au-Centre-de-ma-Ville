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
   public $idUsers = "";
   public $idCommunity = '';

   /**
    * Méthode magique construct contient l'appel à la database ( singleton ) et sa méthode getInstance() 
    * Elle permet d'instancié l'objet dans l'instance à la base de donnée courante. 
    */
   public function __construct() {
      try {
         $this->db = database::getInstance();
      } catch (Exception $ex) {
         die('Erreur : ' . $ex->getMessage());
      }
   }

   /**
    * Création du profil responsable
    * @throws Exception
    */
   public function createService() {
      $query = 'INSERT INTO `CDM25PR_Organization`(`jobTitle`, `service`, `phoneNumberOffice`, `idUsers`, `idCommunity`)  '
              . 'VALUES (:jobTitle ,:service ,:phoneNumberOffice ,:idUsers ,:idCommunity)';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':jobTitle', $this->jobTitle, PDO::PARAM_STR);
      $queryExecute->bindValue(':service', $this->service, PDO::PARAM_STR);
      $queryExecute->bindValue(':phoneNumberOffice', $this->phoneNumberOffice, PDO::PARAM_STR);
      $queryExecute->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
      $queryExecute->bindValue(':idCommunity', $this->idCommunity, PDO::PARAM_INT);
      if (!$queryExecute->execute()) {
         throw new Exception();
      }
   }

   /**
    * Méthode commit pour la transaction
    * @return type
    */
   public function commit() {
      return $this->db->commit();
   }

   /**
    * Méthode rollback pour la transaction
    * @return type
    */
   public function rollback() {
      return $this->db->rollback();
   }

   public function getInfoService() {
      $query = 'SELECT `CDM25PR_Organization`.`jobTitle` , `CDM25PR_Organization`.`service`, `CDM25PR_Organization`.`phoneNumberOffice`, `CDM25PR_community`.`departementEPCI`, `CDM25PR_community`.`nameCity`, `CDM25PR_community`.`nameEPCI` '
              . 'FROM `CDM25PR_Organization` '
              . 'INNER JOIN `CDM25PR_community` '
              . 'ON `CDM25PR_Organization`.`idCommunity` = `CDM25PR_community`.`id` '
              . 'WHERE `CDM25PR_Organization`.`idUsers` = :idUsers';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':idUsers', $_SESSION['id'], PDO::PARAM_INT);
      $queryExecute->execute();
      return $queryExecute->fetch(PDO::FETCH_OBJ);
   }
   
/**
 * Méthode qui modifie les données du profil responsable
 * On passe dans les valeurs de la clé étrangères IdUsers , l'id de la session
 * @return type
 */
   public function updateOrganizations() {
      $query = 'UPDATE `CDM25PR_Organization` '
              . 'SET `jobTitle`= :jobTitle ,`service`= :service ,`phoneNumberOffice`= :phoneNumberOffice '
              . 'WHERE `idUsers` = :idUsers'; 
       $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':jobTitle', $this->jobTitle, PDO::PARAM_STR);
      $queryExecute->bindValue(':service', $this->service, PDO::PARAM_STR);
      $queryExecute->bindValue(':phoneNumberOffice', $this->phoneNumberOffice, PDO::PARAM_STR);
      $queryExecute->bindValue(':idUsers', $_SESSION['id'], PDO::PARAM_INT);
      return $queryExecute->execute();
   }
}

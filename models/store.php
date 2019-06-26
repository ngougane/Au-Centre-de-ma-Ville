<?php


/**
 * Models qui permet de gérer les méthodes des commerces. 
 *
 * @author ngougane
 */
class store {
   
   private $db;
   public $id = 0;
   public $photo  = '';
   public $openingTime = ''; 
   public $idUsers =''; 

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
    * Méthode qui permet de créer un utilisateur commerçant et sa fiche commerce
    * @return type
    */
   public function createStore() {
      $query = 'INSERT INTO `CDM25PR_business`(`photo`, `openingTime`, `idUsers`, `idSiren`) '
              . 'VALUES (:photo, :openingTime, :idUsers, :idSiren)'; 
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':photo', $this->photo, PDO::PARAM_STR);
      $queryExecute->bindValue(':openingTime', $this->openingTime, PDO::PARAM_STR);
      $queryExecute->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
      $queryExecute->bindValue(':idSiren', $this->idSiren, PDO::PARAM_INT);
      return $queryExecute->execute();     
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
       public function rollback(){
      return $this->db->rollback();
   }
   
   public function getInfoStore() {
      $query='SELECT `CDM25PR_business`.`photo`, `CDM25PR_business`.`openingTime`, `CDM25PR_Siren`.`siren`, `CDM25PR_Siren`.`raisonSociale`, `CDM25PR_Siren`.`activity`, `CDM25PR_Siren`.`adresse`, `CDM25PR_city`.`zipCode`, `CDM25PR_city`.`city` '
              . 'FROM `CDM25PR_business` '
              . 'INNER JOIN `CDM25PR_Siren` '
              . 'ON `CDM25PR_business`.`idSiren` = `CDM25PR_Siren`.`id` '
              . 'INNER JOIN `CDM25PR_city` '
              . 'ON `CDM25PR_Siren`.`idCity` = `CDM25PR_city`.`id` '
              . 'WHERE `CDM25PR_business`.`idUsers` = :idUsers';
     $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':idUsers', $_SESSION['id'], PDO::PARAM_INT);
      $queryExecute->execute();
      return $queryExecute->fetch(PDO::FETCH_OBJ);
   }
   
   public function updateStore() {
      $query='UPDATE `CDM25PR_business` '
              . 'SET `photo`= :photo,`openingTime`= :openingTime '
              . 'WHERE `idUsers`= :idUsers';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':photo', $this->photo, PDO::PARAM_STR);
      $queryExecute->bindValue(':openingTime', $this->openingTime, PDO::PARAM_STR);
      $queryExecute->bindValue(':idUsers', $_SESSION['id'], PDO::PARAM_INT);
      return $queryExecute->execute();
   }
}

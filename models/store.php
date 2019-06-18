<?php


/**
 * Models qui permet de gérer les méthodes des commerces. 
 *
 * @author ngougane
 */
class store {
   
   public $id = 0;
   public $photo  = '';
   public $openingTime = ''; 
   public $phoneNumberStore = '';
   public $idCity = ''; 
   public $idUsers =''; 
   public $idSiren = ''; 

   /**
    * Méthode magique construct contient l'appel à la database ( singleton ) et sa méthode getInstance() 
    * Elle permet d'instancié l'objet dans l'instance à la base de donnée courante. 
    */
   public function __construct() {
      try {
         $this->db = database::getInstance()->db;
      } catch (Exception $ex) {
         die('Erreur : ' . $ex->getMessage());
      }
   }
   
   public function createStore() {
      $query = 'INSERT INTO `CDM25PR_business`(`photo`, `openingTime`, `phoneNumberStore`, `idCity`, `idUsers`, `idSiren`) '
              . 'VALUES (:photo, :openingTime, :phoneNumberStore, :idCity, :idUsers, :idSiren)'; 
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':photo', $this->photo, PDO::PARAM_STR);
      $queryExecute->bindValue(':openingTime', $this->openingTime, PDO::PARAM_STR);
      $queryExecute->bindValue(':phoneNumberStore', $this->phoneNumberStore, PDO::PARAM_STR);
      $queryExecute->bindValue(':idCity', $this->idCity, PDO::PARAM_INT);
      $queryExecute->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
      $queryExecute->bindValue(':idSiren', $this->idSiren, PDO::PARAM_INT);
      return $queryExecute->execute(); 
      
   }
   
}

<?php

/*
 * Classe catégorie de produits 
 */

class categoryProducts {
   
   /**
    * @var db est en privé elle n'est accessible que depuis la classe
    * elle permettra de stocker l'instance retourner par le singleton
    */
   private $db;
   public $id = 0;
   public $category = '';
   
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
    * Méthode createCategorieProduct qui permet d'ajouter une catégorie de produit dans la base de données
    * @return bool
    */
   public function createCategorieProduct() {
      $query = 'INSERT INTO `CDM25PR_categoryProducts`(`category`) '
              . 'VALUES (:category)';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':category', $this->category, PDO::PARAM_STR);
      return $queryExecute->execute();
   }
   
       /**
     * Méthode qui permet de commencer une transaction
     * @return type
     */
   public function beginTransaction(){
      return $this->db->beginTransaction();
   }
   
   /**
    * Méthode qui permet de récupérer le dernier id inséré en BDD lors de la transaction 
    * @return type
    */
   public function lastInsertId(){
      return $this->db->lastInsertId();
   }
   
   
}

<?php

/*
 * Class des produits des commerces en click & collect
 */

class products {

   /**
    * @var db est en privé elle n'est accessible que depuis la classe
    * elle permettra de stocker l'instance retourner par le singleton
    */
   private $db;
   public $id = 0;
   public $name = '';
   public $photo = '';
   public $description = '';
   public $price = '';
   public $idCategoryProducts = '';
   public $idBusiness = '';

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
    * Méthode createProducts qui permet d'ajouter un produit en click & collect à un commerce dans la base de données
    * @return bool
    */
   public function createProducts() {
      $query = 'INSERT INTO `CDM25PR_products`(`name`, `photo`, `description`, `price`, `idCategoryProducts`, `idBusiness`) VALUES (:name, :photo, :description, :price, :idCategoryProducts, :idBusiness)';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':name', $this->name, PDO::PARAM_STR);
      $queryExecute->bindValue(':photo', $this->photo, PDO::PARAM_STR);
      $queryExecute->bindValue(':description', $this->description, PDO::PARAM_STR);
      $queryExecute->bindValue(':price', $this->price, PDO::PARAM_STR);
      $queryExecute->bindValue(':idCategoryProducts', $this->idCategoryProducts, PDO::PARAM_INT);
      $queryExecute->bindValue(':idBusiness', $this->idBusiness, PDO::PARAM_INT);
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
   public function rollback() {
      return $this->db->rollback();
   }

   /**
    * Méthode qui retourne la liste des produits d'un commerce
    * @return type tableaux d'objets 
    */
   public function getListProducts() {
      $query = 'SELECT `CDM25PR_products`.`id`, `CDM25PR_products`.`photo`, `CDM25PR_products`.`name`, `CDM25PR_products`.`description`, `CDM25PR_products`.`price`, `CDM25PR_categoryProducts`.`category` '
              . 'FROM `CDM25PR_products` INNER JOIN `CDM25PR_categoryProducts` '
              . 'ON `CDM25PR_categoryProducts`.`id` = `CDM25PR_products`.`idCategoryProducts` '
              . 'WHERE `CDM25PR_products`.`idBusiness` = :idBusiness';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':idBusiness', $this->idBusiness, PDO::PARAM_INT);
      $queryExecute->execute();
      return $queryExecute->fetchAll(PDO::FETCH_OBJ);
   }

   /**
    * Méthode qui permet d'afficher un produit d'un commerce par son id
    * @return type
    */
   public function readProductByStrore() {
      $query = 'SELECT `CDM25PR_products`.`name`, `CDM25PR_products`.`photo`, `CDM25PR_products`.`description`, `CDM25PR_products`.`price`, `CDM25PR_categoryProducts`.`category` '
              . 'FROM `CDM25PR_products` '
              . 'INNER JOIN `CDM25PR_categoryProducts` '
              . 'ON `CDM25PR_categoryProducts`.`id`= `CDM25PR_products`.`idCategoryProducts` '
              . 'WHERE `CDM25PR_products`.`idBusiness`= :idBusiness'
              . 'AND `CDM25PR_products`.`id` = :id';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':idBusiness', $this->idBusiness, PDO::PARAM_INT);
      $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
      $queryExecute->execute();
      return $queryExecute->fetchAll(PDO::FETCH_OBJ);
   }

   /**
    * Méthode permettant la suppression d'un produit d'un commerce
    * On utilisera l'id stocké dans la variable get
    * @return bool true si la requête s'est éxécutée, sinon false
    */
   public function deleteProduct() {
      $query = 'DELETE FROM `CDM25PR_products` '
              . 'WHERE `id`= :id';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
      return $queryExecute->execute();
   }

}

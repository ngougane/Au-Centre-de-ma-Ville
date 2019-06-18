<?php
require_once 'database.php';
/**
 * Classe qui gère les roles et les droits des utilisateurs 
 *
 * @author ngougane
 */
class roles {

   private $db;
   public $id = 0;
   public $name = '';

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
    * Methode qui permet d'avoir la liste des rôles 
    * lors de l'inscription d'un utilisateur
    * @return tableau d'objets
    */
   public function getRoleUserSubscription() {
      $query = 'SELECT `id`, `name` '
              . 'FROM `CDM25PR_roles` '
              . 'WHERE `name` <> "Administrateur" ';
      $queryExecute = $this->db->query($query);
      $queryExecute->execute();
      return $queryExecute->fetchall(PDO::FETCH_OBJ);
   }

}

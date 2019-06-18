<?php

require_once 'database.php';

/**
 * Classe civility : renvoie la civilité  of civility
 *
 * @author ngougane
 */
class civility {
   /**
    * @var db est en privé elle n'est accessible que depuis la classe
    * elle permettra de stocker l'instance retourner par le singleton
    */
   private $db;
   public $id = 0;
   public $civility = ''; 
   
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
   
   // affiche la liste des civilités 
   
   public function getCivility() {
      $query = 'SELECT `id`, `civility` '
              . 'FROM `CDM25PR_civility`';
      $queryExecute = $this->db->query($query);
      $queryExecute->execute();
      return $queryExecute->fetchall(PDO::FETCH_OBJ);
   }
}

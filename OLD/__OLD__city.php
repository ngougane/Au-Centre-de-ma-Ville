
<?php

/**
 * Classe qui crée l'objet ville 
 * 
 *
 * @author ngougane
 */
class city {
   public $id = 0;
   public $zipCode ='';
   public   $city = ''; 
   public $idUsers ='';
/**
 * Méthode magique construct contient l'appel à la database ( singleton ) et sa méthode getInstance() 
 * Elle permet d'instancié l'objet dans l'instance à la base de donnée courante. 
 */
   public function __construct() {
      try {
         $this->db= database::getInstance()->db;
      } catch (Exception $ex) {
         die('Erreur : ' . $ex->getMessage());
      }
   }
   
    /**
    * Méthode addCity qui permet d'ajouter un utilisateur dans la base de données
    * @return l'execution de la requête insert
    */
   public function addCity(){
      $query = 'INSERT INTO `CDM25PR_city`(`zipCode`, `city`, `idUsers`) '
              . 'VALUES (:zipCode, :city , :idUsers )';
      $queryExecute= $this->db->prepare($query);
      $queryExecute->bindValue(':zipCode', $this->zipCode, PDO::PARAM_INT);
      $queryExecute->bindValue(':city', $this->city, PDO::PARAM_STR);
      $queryExecute->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
      return $queryExecute->execute();
   }

}

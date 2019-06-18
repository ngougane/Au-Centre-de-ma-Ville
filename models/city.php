<?php

/**
 * Description of city
 *
 * @author ngougane
 */
class city {
   
   public $id = 0;
   public $zipCode ='';
   public   $city = ''; 
   
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
   
       /**
     * Je crée une méthode qui contient une requête SELECT
     * dans la clause WHERE j'utilise un LIKE mais je ne mets pas les modulos dans la requête (sinon ça ne fonctionne pas)
     * La méthode reste une fonction on peut donc lui passer un paramètre. Ici search n'est pas un attribut de patient, 
     * pour l'injecter dans la requête on le passe en paramètre dans la méthode.
     * @param text $search
     * @return array
     */
   public function searchZipcode($search){
       $query = 'SELECT `id`, `zipcode`, `city` '
               . 'FROM `CDM25PR_city` '
               . 'WHERE `zipcode` LIKE :search '
               . 'ORDER BY `city` ASC';
       $queryExecute = $this->db->prepare($query);
       //On peut concaténer les modulos ici où dans le contrôleur
       $queryExecute->bindValue(':search', $search .'%', PDO::PARAM_STR);
       $queryExecute->execute();
       return $queryExecute->fetchAll(PDO::FETCH_OBJ);   
   }
   
//   /**
//    * 
//    * @return type
//    */
//       public function getListCity() {
//        $query = 'SELECT `id`, `zipcode`, `city` '
//                . 'FROM `CDM25PR_city` ';
//        $queryExecute = $this->db->query($query);
//        return $queryExecute->fetchAll(PDO::FETCH_OBJ);
//    }

}

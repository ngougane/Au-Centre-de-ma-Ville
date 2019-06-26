<?php
require_once 'database.php';
/**
 * Classe qui gére les numéros de Siren des commerc
 *
 * @author ngougane
 */
class siren {
   
   private $db;
   public $id = 0;
   public $siren= ''; 
   public $raisonSociale='';
   public $activity='';


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
     * La méthode reste une fonction on peut donc lui passer un paramètre. Ici search n'est pas un attribut de la classe, 
     * pour l'injecter dans la requête on le passe en paramètre dans la méthode.
     * @param text $sirenSearch
     * @return array
     */
   public function searchSirenCode($sirenSearch){
       $query = 'SELECT `id`, `siren`, `raisonSociale`, `activity` '
               . 'FROM `CDM25PR_Siren` '
               . 'WHERE `siren` LIKE :sirenSearch '
               . 'ORDER BY `siren` ASC';
       $queryExecute = $this->db->prepare($query);
       //On peut concaténer les modulos ici où dans le contrôleur
       $queryExecute->bindValue(':sirenSearch', $sirenSearch .'%', PDO::PARAM_STR);
       $queryExecute->execute();
       return $queryExecute->fetchAll(PDO::FETCH_OBJ);   
   }
   
}


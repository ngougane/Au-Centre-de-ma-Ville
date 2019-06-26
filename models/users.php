<?php

require_once 'database.php';

/**
 * Classe utilisateur : un user est un utilisateur lambda
 * La classe contient les attributs commun à chaque utilisateurs du site. 
 * @author ngougane
 *
 */
class users {

   /**
    * @var db est en privé elle n'est accessible que depuis la classe
    * elle permettra de stocker l'instance retourner par le singleton
    */
   private $db;
   public $id = 0;
   public $firstname = '';
   public $lastname = '';
   public $adresse = '';
   public $phoneNumber = '';
   public $mail = '';
   public $password = '';
   public $idCity = '';
   public $idRoles = '';
   public $idCivility = '';

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
    * Méthode createUser qui permet d'ajouter un utilisateur dans la base de données
    * @return bool
    */
   public function createUser() {
      $query = 'INSERT INTO `CDM25PR_users` (`firstname`, `lastname`, `adresse`, `phoneNumber`, `mail`,`password`,`idCity`, `idRoles`, `idCivility`) '
              . 'VALUES (:firstname, :lastname , :adresse , :phoneNumber, :mail, :password , :idCity , :idRoles , :idCivility)';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
      $queryExecute->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
      $queryExecute->bindValue(':adresse', $this->adresse, PDO::PARAM_STR);
      $queryExecute->bindValue(':phoneNumber', $this->phoneNumber, PDO::PARAM_STR);
      $queryExecute->bindValue(':mail', $this->mail, PDO::PARAM_STR);
      $queryExecute->bindValue(':password', $this->password, PDO::PARAM_STR);
      $queryExecute->bindValue(':idCity', $this->idCity, PDO::PARAM_INT);
      $queryExecute->bindValue(':idRoles', $this->idRoles, PDO::PARAM_INT);
      $queryExecute->bindValue(':idCivility', $this->idCivility, PDO::PARAM_INT);
      return $queryExecute->execute();
   }

   
   
   /**
    * Méthode permettant de vérifier si l'utilisateur existe déjà avant de le créer.
    * Retour possible : false -> la requête ne s'est pas exécutée.
    *                   0     -> l'utilisateur est disponible.
    *                   1     -> l'utilisateur existe déja.
    * @return boolean
    */
   public function checkUserExist() {

      // On vérifie si le mail existe déja, dans la table 
      $query = 'SELECT COUNT( `id`) AS `count` '
              . 'FROM `CDM25PR_users` '
              . 'WHERE `mail` = :mail ';
      $queryExcecute = $this->db->prepare($query);
      $queryExcecute->bindValue(':mail', $this->mail, PDO::PARAM_STR);
      // Si la méthode (ici $queryExecute)->execute() = true
      $queryExcecute->execute();
      return $queryExcecute->fetch(PDO::FETCH_OBJ);
   }

   /**
    * Méthode permettant de récupérer le hash du mot de passe, on pourra le 
    * comparer à celui tapé lors de la connexion
    * @return object
    */
   public function getHashByMail() {
      $query = 'SELECT  `id`, `password`, `lastname`, `firstname`, `idRoles` '
              . 'FROM `CDM25PR_users` '
              . 'WHERE `mail` = :mail';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':mail', $this->mail, PDO::PARAM_STR);
      $queryExecute->execute();
      return $queryExecute->fetch(PDO::FETCH_OBJ);
   }

   /**
    * Méthode qui permettra d'afiicher les informations d'un utilisateur 
    * @return object
    */
   public function getUserInfo() {
      $query ='SELECT `civility`,`firstname`,`lastname`,`mail`,`phoneNumber`, `adresse`, `zipcode`,`city` ,  `CDM25PR_users`.`id`  '
              . 'FROM `CDM25PR_users` '
              . 'INNER JOIN `CDM25PR_civility` '
              . 'ON `CDM25PR_civility`.`id` = `CDM25PR_users`.`idCivility` '
              . 'INNER JOIN `CDM25PR_city` '
              . 'ON `CDM25PR_city`.`id` = `CDM25PR_users`.`idCity` '
              . 'WHERE`CDM25PR_users`.`id` = :id';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
      $queryExecute->execute();
      return $queryExecute->fetch(PDO::FETCH_OBJ);
   }

   /**
    * Méthode qui permet d'avoir l'idSiren de l'user commerçant afin de le récupérer dans les infos de session
    * @return type
    */
      public function getUserBySiren() {
      $query ='SELECT `CDM25PR_business`.`idSiren`, `CDM25PR_business`.`id` AS idStore '
              . 'FROM `CDM25PR_business` '
              . 'INNER JOIN `CDM25PR_users` '
              . 'ON `CDM25PR_business`.`idUsers` = `CDM25PR_users`.`id` '
              . 'WHERE `CDM25PR_users`.`id` = :id';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
      $queryExecute->execute();
      return $queryExecute->fetch(PDO::FETCH_OBJ);
   }
   /**
    * Méthode qui modifie les données de l'utilisateur
    */
   public function updateUser() {
      $query = 'UPDATE `CDM25PR_users` '
              . 'SET `firstname`= :firstname ,`lastname`= :lastname,`mail`= :mail,`phoneNumber`= :phoneNumber '
              . 'WHERE `CDM25PR_users`.`id` = :id';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
      $queryExecute->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
      $queryExecute->bindValue(':mail', $this->mail, PDO::PARAM_STR);
      $queryExecute->bindValue(':phoneNumber', $this->phoneNumber, PDO::PARAM_STR);
      $queryExecute->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
      return $queryExecute->execute();
   }

   /**
     * Méthode permettant la suppression du compte d'un utilisateur
     * Grâce au DELETE ON CASCADE présent dans le script de création de ma base
    * On utilisera l'id stocké dans la Session. 
     * @return bool true si la requête s'est éxécutée, sinon false
     */
    public function deleteUser() {
        $query = 'DELETE FROM `CDM25PR_users` '
                . 'WHERE `id`= :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
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

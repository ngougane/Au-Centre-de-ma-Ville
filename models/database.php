<?php
/*
 *Le singleton est un design pattern qui permettra de gérer les instances de connexion de PDO
 * @return $db instance unique de connexion. 
 */

class database {

     /**
     * L'attribut $db est public il peut être appelé à l'extérieur de la classe
     * L'attribut $instance est en privé afin qu'il ne soit pas accessible en dehors de la class Database
     */
   public $db;
   private static $instance=NULL;
     /**
     * Je mets la méthode magique en privée pour qu'elle ne soit pas utilisé en dehors de la classe.
     * Donc l'objet ne peut être créé en dehors de la classe.
     */
   private function __construct() {
      //$this->db=new PDO('mysql:host=localhost; dbname=centredemaville; charset=utf8',  'adminCentre', '123456');
   }
     /**
     * La méthode getInstance() est en public afin de l'appelé en dehors de ma classe.
      * Elle est static on peut l'appelé sans avoir à instancié un objet
     */
   public static function getInstance(){
  
      if(is_null(self::$instance)){
           /**
             * S'il est égal à NULL alors $instance est égal à l'instanciation de Database
             */
         self::$instance = new PDO('mysql:host=localhost; dbname=centredemaville; charset=utf8',  'adminCentre', '123456');
      }
              /**
         * Je retourne l'instance. Si elle existait je la prend sinon je l'ai créé juste avant.
         */
      return self::$instance;
   }
}

<?php

/**
 * Classe qui a fonction de charger automatiquement dans les vues les appels vers les classes
 * afin d'éviter les oublis vers les require. 
 * Elle charge la classe dès l'instanciation via la fonction new
 *
 * @author ngougane
 */
class autoloader {
   
   /**
    * Fonction qui fait appel à la méthode spl_autoload_register
    * cette méthode permet d'enregistrer une fonction en qu'implémentation de l'auto-chargement
    * Si la pile des autolaod n'est pas encore active, elle est activée
    * spl_autoload_register permet également d'utiliser plusieurs fonctions d'autochargement. 
    * Elle prend en paramètre __CLASS__ : constante magique qui permet de récupérer le nom de la class courante
    * et l'appelle à la fonction autoload 
    * @return bolean  true ajoutera au début de la pile
    */
   static function registrer(){
      
      spl_autoload_register(array(__CLASS__,'autoload'));
   }

   /**
    * Fonction qui fera appel au require des classes
    * elle est static car elle n'a pas besoin d'être instancié
    * @param type $className
    * On y fera appel à la méthode autoloader :: autoload 
    */
   static function autoload ($className){
         require 'models/' . $className . '.php';
   }

}

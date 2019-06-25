<?php
//appel à la class autoloader 
//sa méthode permet de charger de manière dynamique les classes 
// dès qu'elles sont instanciés
require_once 'models/autoloader.php';
autoloader::registrer();
//On instancie la class user 
 $user = new users();
 //on fait appel à la méthode qui permettra d'afficher les info de l'utilisateur. 
 $infoUser = $user->getUserInfo();


<?php
//voir si je continue à utiliser ce controleur 

isset($_SESSION) ? '' : session_start();
//appel à la class autoloader 
//sa méthode permet de charger de manière dynamique les classes 
// dès qu'elles sont instanciés
require_once 'models/autoloader.php';
autoloader::registrer();
//On instancie la class user 
 $user = new users();
 //on fait appel à la méthode qui permettra d'afficher les info de l'utilisateur. 
 $infoUser = $user->getUserInfo();
//On instancie la class organization 
 $service = new organizations();
 //on fait appel à la méthode qui permettra d'afficher les info de l'utilisateur. 
 $infoService = $service->getInfoService();
//On instancie la class store
$store = new store();

 //on fait appel à la méthode qui permettra d'afficher les info de l'utilisateur. 
 $infoStore = $store->getInfoStore();
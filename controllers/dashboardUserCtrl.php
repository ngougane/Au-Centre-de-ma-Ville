<?php

//// voir si on supprime /////////////////////////////////////////////////////////////////////**
//appel à la class autoloader 
//sa méthode permet de charger de manière dynamique les classes 
// dès qu'elles sont instanciés
require_once 'models/autoloader.php';
autoloader::registrer();
require 'includes/regex.php';

// Je crée le tableau des erreurs que j'initialise vide
$formErrors = array();
$formSuccess = '';
$user = new users();


/**
 * Vérification des champs du formulaire 
 * pour la modification (update) de l'utilisateur 
 */
if (count($_POST) > 0) {

   if (!empty($_POST['firstname'])) {
      if (preg_match($regexName, $_POST['firstname'])) {
         $user->firstname = htmlspecialchars($_POST['firstname']);
      } else {
         $formErrors['firstname'] = 'Veuillez renseigner un prénom valide';
      }
   } else {
      $formErrors['firstname'] = 'Veuillez renseigner votre prénom';
   }

   if (!empty($_POST['lastname'])) {
      if (preg_match($regexName, $_POST['lastname'])) {
         $user->lastname = htmlspecialchars($_POST['lastname']);
      } else {
         $formErrors['lastname'] = 'Veuillez renseigner un nom de famille valide';
      }
   } else {
      $formErrors['lastname'] = 'Veuillez renseigner votre nom de famille';
   }

   if (!empty($_POST['phonenumber'])) {
      if (preg_match($regexPhoneNumber, $_POST['phonenumber'])) {
         $user->phonenumber = htmlspecialchars($_POST['phonenumber']);
      } else {
         $formErrors['phonenumber'] = 'Veuillez renseigner un numéro valide';
      }
   } else {
      $formErrors['phonenumber'] = 'Veuillez renseigner votre nom de famille';
   }

   if (!empty($_POST['mail'])) {
      if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
         $user->mail = htmlspecialchars($_POST['mail']);
      } else {
         $formErrors['mail'] = 'Veuillez renseigner un numéro valide';
      }
   } else {
      $formErrors['mail'] = 'Veuillez renseigner votre nom de famille';
   }

//   On vérifie s'il n'y a pas d'erreurs dans le tableau (formErrors) 
   if (count($formErrors) == 0) {
      // si la condition est remplie j'appelle la méthode 
      $user->updateUser();
      $formSuccess = 'Vos modifications ont été pris en compte.';
   }
}

/**
 * Lecture (read) des informations de l'utilisateur
 */
if (!empty($_SESSION['id'])) {
   if (filter_var($_SESSION['id'], FILTER_VALIDATE_INT)) {
      $user->id = htmlspecialchars($_SESSION['id']);
      //On récupére l'id de la session en cours pour l'affecter à l'attribut de l'instance user
      //et on appelle la méthode qui affichera tous les informations de l'utilisateur
      $infoUser = $user->getUserInfo();
   }
}

/**
 * Suppresion du compte de l'utilisateur
 */
if (!empty($_GET['deleteId'])){
   if (filter_var($_GET['deleteId'], FILTER_VALIDATE_INT)) {
      $user->id = htmlspecialchars($_GET['deleteId']);
      //On récupére l'id de la session en cours pour l'affecter à l'attribut de l'instance user
      //et on appelle la méthode qui supprimera le compte de l'utilisateur 
      if ($user->deleteUser()) {
         $deleteSuccess = 'Votre compte a bien été supprimé';
         header('Location : ../index.php');
      } else {
         $deleteError = 'Votre compte n\'a pas été supprimé';
      }
   }
}

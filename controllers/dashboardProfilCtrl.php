<?php

session_start();
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
$organization = new organizations();
$store = new store();
/**
 * Vérification des champs du formulaire 
 * pour la modification (update) de l'utilisateur 
 */
if (count($_POST) > 0) {
   //bolléen de succes d'envoie du fichier 
   $successDoc = false;
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

   if (!empty($_POST['phoneNumber'])) {
      if (preg_match($regexPhoneNumber, $_POST['phoneNumber'])) {
         $user->phoneNumber = htmlspecialchars($_POST['phoneNumber']);
      } else {
         $formErrors['phoneNumber'] = 'Veuillez renseigner un numéro valide';
      }
   } else {
      $formErrors['phoneNumber'] = 'Veuillez renseigner votre nom de famille';
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

   if ((isset($_SESSION['role'])) && ($_SESSION['role'] == 23)) {
      //Vérification du fichier d'image 
      if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
         if ($_FILES['file']['size'] <= 5000000) {
            $infoFIle = pathinfo($_FILES['file']['name']);
            $fileExtend = $infoFIle['extension'];
            $authExtend = ['png', 'jpg', 'jpeg'];
            if (in_array($fileExtend, $authExtend)) {
               $successDoc = true;
            } else {
               $formErrors['file'] = 'Veuillez insérer un fichier pdf ou jpg';
            }
         } else {
            $formErrors['file'] = 'Le fichier est trop volumineux';
         }
      } else {
         $formErrors['file'] = 'Une erreur est survenue';
      }
      //vérifications des horaires d'ouverture
      if (!empty($_POST['openingTime'])) {
         if (preg_match($regexAddress, $_POST['openingTime'])) {
            //Je stocke le résultat dans une variable 
            $store->openingTime = htmlspecialchars($_POST['openingTime']);
         } else {
            $formErrors['openingTime'] = 'Veuillez saisir des horaires valides';
         }
      } else {
         $formErrors['openingTime'] = 'Veuillez renseigner vos horaires d\'ouverture';
      }
   }

   if ((isset($_SESSION['role'])) && ($_SESSION['role'] == 24)) {

      if (!empty($_POST['jobTitle'])) {
         if (preg_match($regexName, $_POST['jobTitle'])) {
            $organization->jobTitle = htmlspecialchars($_POST['jobTitle']);
         } else {
            $formErrors['jobTitle'] = 'Veuillez saisir un nom de poste';
         }
      } else {
         $formErrors['jobTitle'] = 'Veuillez renseigner un nom de poste';
      }

      if (!empty($_POST['service'])) {
         if (preg_match($regexName, $_POST['service'])) {
            $organization->service = htmlspecialchars($_POST['service']);
         } else {
            $formErrors['service'] = 'Veuillez saisir un nom de poste';
         }
      } else {
         $formErrors['service'] = 'Veuillez renseigner un nom de poste';
      }

      if (!empty($_POST['phoneNumberService'])) {
         if (preg_match($regexPhoneNumber, $_POST['phoneNumberService'])) {
            $organization->phoneNumberOffice = htmlspecialchars($_POST['phoneNumberService']);
         } else {
            $formErrors['phoneNumberService'] = 'Veuillez saisir un nom de poste';
         }
      } else {
         $formErrors['phoneNumberService'] = 'Veuillez renseigner un nom de poste';
      }
   }

//   On vérifie s'il n'y a pas d'erreurs dans le tableau (formErrors) 
   if (count($formErrors) == 0) {
      // si la condition est remplie j'appelle la méthode 
      if ((isset($_SESSION['role'])) && ($_SESSION['role'] == 22)) {
         $user->updateUser();
         $formSuccess = 'Vos modifications ont été pris en compte.';
      } else {
         $formErrors['results'] = 'Vos modifications n\'ont pas été validé';
      }
      if ((isset($successDoc)) && $successDoc === true) {
         if (isset($_SESSION['role']) && ($_SESSION['role'] == 23)) {
            $target_dir = time() . '.' . $fileExtend;
            $store->photo = $target_dir;
            move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . basename($store->photo));
            chmod('uploads/' . basename($store->photo), 0755);
            try {
               $user->beginTransaction();
               $user->updateUser();
               $store->idUsers = $user->lastInsertId();
               $store->updateStore();
               $store->commit();
               $formSuccess = 'Vos modifications ont été pris en compte.';
            } catch (Exception $ex) {
               $store->rollback();
               $formErrors['results'] = 'Vos modifications n\'ont pas été validé';
               die('Error : ' . $ex);
            }
         }
      }

      if (isset($_SESSION['role']) && ($_SESSION['role'] == 24)) {
         try {
            $user->beginTransaction();
            $user->updateUser();
            $organization->idUsers = $user->lastInsertId();
            $organization->updateOrganizations();
            $organization->commit();
            $formSuccess = 'Vos modifications ont été pris en compte.';
         } catch (Exception $ex) {
            $organization->rollback();
            $formErrors['results'] = 'Vos modifications n\'ont pas été validé';
            die('Error : ' . $ex);
         }
      }
   }
}

/**
 * Lecture (read) des informations de l'utilisateur selon leur role
 */
if (!empty($_SESSION['id'])) {
   if (filter_var($_SESSION['id'], FILTER_VALIDATE_INT)) {
      $user->id = htmlspecialchars($_SESSION['id']);
      //On récupére l'id de la session en cours pour l'affecter à l'attribut de l'instance user
      //et on appelle la méthode qui affichera tous les informations de l'utilisateur

      if ((isset($_SESSION['role'])) && ($_SESSION['role']) == 22) {
         $infoUser = $user->getUserInfo();
      }
      if ((isset($_SESSION['role'])) && ($_SESSION['role']) == 23) {
         $infoStore = $store->getInfoStore();
      }
      if ((isset($_SESSION['role'])) && ($_SESSION['role']) == 24) {
         $infoService = $organization->getInfoService();
      }
   }
}

/**
 * Suppresion du compte de l'utilisateur
 */
if (!empty($_GET['deleteId'])) {
   if (filter_var($_GET['deleteId'], FILTER_VALIDATE_INT)) {
      $user->id = htmlspecialchars($_GET['deleteId']);
      //On récupére l'id de la session en cours pour l'affecter à l'attribut de l'instance user
      //et on appelle la méthode qui supprimera le compte de l'utilisateur 
      if ($user->deleteUser()) {
         $deleteSuccess = 'Votre compte a bien été supprimé';
         header('location: index.php');
      } else {
         $deleteError = 'Votre compte n\'a pas été supprimé';
      }
   }
}

<?php
isset($_SESSION)? '' : session_start();
//appel à la class autoloader
//sa méthode permet de charger de manière dynamique les classes
// dès qu'elles sont instanciés
require_once 'models/autoloader.php';
autoloader::registrer();
require_once 'includes/regex.php';
$formErrors = array();
  $formSuccess = '';

if (count($_POST) > 0) {
   $user = new users();
   if (!empty($_POST['mail'])) {
      if (preg_match($regexMail, $_POST['mail'])) {
         $user->mail = htmlspecialchars($_POST['mail']);
      } else {
         $formErrors['mail'] = 'Ce mail est incorrect';
      }
   } else {
      $formErrors['mail'] = 'L\'adresse mail est obligatoire';
   }

   if (!isset($_POST['password']) || empty($_POST['password'])) {
      $formErrors['password'] = 'Le mot de passe est obligatoire';
   }

   if (count($formErrors) == 0) {
      //Après mes vérifications habituelles, on lance la méthode checkUser afin de vérifier si l'utilisateur existe bien.
      $check = $user->checkUserExist();
      if ($check->count == 1) {
         //Si l'utilisateur existe je récupère le hash de son mot de passe pour le comparé au mot de passe tapé
         $hash = $user->getHashByMail();
         //On utilise la fonction password_verify pour vérifier que les mots de passe correspondent
         if (password_verify($_POST['password'], $hash->password)) {
            /**
             * Si les mots de passe correspondent, on crée une session et les variables de session qui contiendront
             * tous les éléments que l'on souhaite conserver tout au long de la connexion
             * Il faut appeler session_start sur toutes les pages pour que l'on ai accès aux
             * variables de session. C'est ce qui constitue la connexion en elle-même.
             */
            $formSuccess = '';
            $_SESSION['mail'] = $user->mail;
            $_SESSION['id'] = $hash->id;
            $_SESSION['role'] = $hash->idRoles;
            $_SESSION['lastname'] = $hash->lastname;
            $_SESSION['firstname'] = $hash->firstname;
            header('location:../dashboard.php');
            $checksiren= $user->getUserBySiren();
            var_dump($checksiren);
            if((isset($_SESSION['role'])) && $_SESSION['role'] == 23){
               $_SESSION['idSiren'] = $checksiren->idSiren;
               $_SESSION['idStore'] = $checksiren->idStore;
            }
         } else {
            $formErrors['password'] = 'Le mot de passe est invalide';
         }
      } else {
         $formErrors['check'] = 'Cette adresse mail n\'est inscrite, veuillez créer un compte';
      }
   }
}


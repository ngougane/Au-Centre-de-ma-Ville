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
$categoy = new categoryProducts();
$product = new products();
//Je récupére une donnée en session si elle existe 
if (isset($_SESSION['idStore'])) {
   $product->idBusiness = $_SESSION['idStore'];
}

if (count($_POST) > 0) {
   //bolléen de succes d'envoie du fichier 
   $successDoc = false;
   //vérification de la catégorie 
   if (!empty($_POST['category'])) {
      if (preg_match($regexName, $_POST['category'])) {
         $categoy->category = htmlspecialchars($_POST['category']);
      } else {
         $formErrors['category'] = 'Merci de renseigner une catégorie valide';
      }
   } else {
      $formErrors['category'] = 'Merci de renseigner votre catégorie';
   }

   //vérification du nom du produit 
   if (!empty($_POST['name'])) {
      if (preg_match($regexNameService, $_POST['name'])) {
         $product->name = htmlspecialchars($_POST['name']);
      } else {
         $formErrors['name'] = 'Merci de renseigner un nom valide';
      }
   } else {
      $formErrors['name'] = 'Merci de renseigner le nom de votre produit';
   }

   //vérification de la description
   if (!empty($_POST['description'])) {
      if (preg_match($regexAddress, $_POST['description'])) {
         $product->description = htmlspecialchars($_POST['description']);
      } else {
         $formErrors['description'] = 'Merci de renseigner une description';
      }
   } else {
      $formErrors['description'] = 'Merci de renseigner une description';
   }

   //vérification du prix
   if (!empty($_POST['price'])) {
      //j'utilise filter var pour vérifier le prix
      if (filter_var($_POST['price'], FILTER_VALIDATE_FLOAT)) {
         $product->price = htmlspecialchars($_POST['price']);
      } else {
         $formErrors['price'] = 'Merci de renseigner un prix';
      }
   } else {
      $formErrors['price'] = 'Merci de renseigner un prix';
   }

   //vérification de la photo
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

   if (count($formErrors) == 0) {
      // upload du fichier inmage 
      $target_dir = time() . '.' . $fileExtend;
      $product->photo = htmlspecialchars($target_dir);
      move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . basename($product->photo));
      chmod('uploads/' . basename($product->photo), 0755);




      // transaction de la catégorie produit et du produit
      try {
         $categoy->beginTransaction();
         $categoy->createCategorieProduct();
         $product->idCategoryProducts = $categoy->lastInsertId();
         $product->createProducts();
         $product->commit();
         $formSuccess = 'Votre produit a bien été ajouté.';
      } catch (Exception $ex) {
         $product->rollback();
         $formErrors['transaction'] = 'Veuillez nous excuser, votre incription n\'a pas abouti. ';
         die('Error : ' . $ex);
      }
   }
}



/**
 * Suppresion du compte de l'utilisateur
 */
if (!empty($_GET['delete'])) {
   if (filter_var($_GET['delete'], FILTER_VALIDATE_INT)) {
      $product->id = htmlspecialchars($_GET['delete']);
      //On récupére l'id de la session en cours pour l'affecter à l'attribut de l'instance user
      //et on appelle la méthode qui supprimera le compte de l'utilisateur 
      if ($product->deleteProduct()) {
         $deleteSuccess = 'Votre produit a bien été supprimé';
      } 
   }
}

//Après avoir instancié l'objet, on appelle la méthode qui permettra d'afficher la liste des produits
$listProducts = $product->getListProducts();

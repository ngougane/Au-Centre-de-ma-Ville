<?php

/**
 * Recherche ajax de la ville via la saisie du code postal 
 */
if (isset($_POST['search'])) {
   //je ne charge pas l'autoloader car il risque de rentrer en conflit
   //avec les chemins pour l'appel à Ajax
//appel à la database qui est le singleton
   require '../models/database.php';
   require '../models/city.php';
   require_once '../includes/regex.php';
   $city = new city();

   if (preg_match($regexSearch, $_POST['search'])) {
      //json_encode permet de faire l'affichage 
      echo json_encode($city->searchZipcode($_POST['search']));
   } else {
      echo $_POST['search'];
   }
} elseif (isset($_POST['sirenSearch'])) {
   //je ne charge pas l'autoloader car il risque de rentrer en conflit
   //avec les chemins pour l'appel à Ajax
//appel à la database qui est le singleton
   require '../models/database.php';
   // appel
   require '../models/siren.php';
   require_once '../includes/regex.php';
   $siren = new siren();

   if (preg_match($regexSearch, $_POST['sirenSearch'])) {
      echo json_encode($siren->searchSirenCode($_POST['sirenSearch']));
   } else {
      echo $_POST['sirenSearch'];
   }
} elseif (isset($_POST['sirenCitySearch'])) {
   //je ne charge pas l'autoloader car il risque de rentrer en conflit
   //avec les chemins pour l'appel à Ajax
//appel à la database qui est le singleton
   require '../models/database.php';
   // appel
   require '../models/sirenCity.php';
   require_once '../includes/regex.php';
   $sirenCity = new sirenCity();


   if (preg_match($regexSearch, $_POST['sirenCitySearch'])) {
      echo json_encode($sirenCity->searchSirenCity($_POST['sirenCitySearch']));
   } else {
      echo $_POST['sirenCitySearch'];
   }
} else {
   //appel à la class autoloader
//sa méthode permet de charger de manière dynamique les classes
// dès qu'elles sont instanciés
   require_once 'models/autoloader.php';
   autoloader::registrer();
//On appelle le fichier contenant les regex
   require_once 'includes/regex.php';
// On crée le tableau des erreurs que j'initialise vide
   $formErrors = array();
   $formSuccess = '';
   //On instancie la classe user
   $user = new users();
//On instancie la classe role
   $roles = new roles();
//On appelle la méthode qui va afficher les rôles possible à la création d'un utilisateur
   $listroles = $roles->getRoleUserSubscription();
// j'instancie la classe civilité
   $civility = new civility();
//j'appelle la méthode qui me permettra d'afficher la liste des civilités
   $listcivility = $civility->getCivility();
   $organization = new organizations();
   $siren = new siren();
   $store = new store();

   if (count($_POST) > 0) {
      //bolléen de succes d'envoie du fichier 
      $successDoc = false;

//Vérification du champs rôle
      if (!empty($_POST['role'])) {
         if (preg_match($regexSearch, $_POST['role'])) {
            $user->idRoles = htmlspecialchars($_POST['role']);
         }
      } else {
         $formErrors['role'] = 'Merci de renseigner votre situation';
      }

      //Vérification de la civilité 
      //la fonction filter_var permet de vérifier que la valeur en post est bien un int
      if (!empty($_POST['civility'])) {
         if (filter_var($_POST['civility'], FILTER_VALIDATE_INT)) {
            $user->idCivility = htmlspecialchars($_POST['civility']);
         }
      } else {
         $formErrors['civility'] = 'Merci de renseigner votre civilité';
      }

//vérification du prénom
      if (!empty($_POST['firstname'])) {
         if (preg_match($regexName, $_POST['firstname'])) {
            $user->firstname = htmlspecialchars($_POST['firstname']);
         } else {
            $formErrors['firstname'] = 'Veuillez saisir un prénom valide';
         }
      } else {
         $formErrors['firstname'] = 'Veuillez renseigner votre prénom';
      }
//vérification du nom
      if (!empty($_POST['lastname'])) {
         if (preg_match($regexName, $_POST['lastname'])) {
            $user->lastname = htmlspecialchars($_POST['lastname']);
         } else {
            $formErrors['lastname'] = 'Veuillez saisir un nom de famille valide';
         }
      } else {
         $formErrors['lastname'] = 'Veuillez renseigner votre nom de famille';
      }
//vérification de l'adresse
      if (!empty($_POST['address'])) {
         if (preg_match($regexAddress, $_POST['address'])) {
            $user->adresse = htmlspecialchars($_POST['address']);
         } else {
            $formErrors['address'] = 'Merci de renseigner une adresse valide';
         }
      } else {
         $formErrors['address'] = 'Merci de renseigner votre adresse';
      }

//  Je vérifie que la saisie qui lancera la recherche ajax du code postal est bien valide
      if (!empty($_POST['zipcode'])) {
         if (preg_match($regexZipCode, $_POST['zipcode'])) {
            $zipcode = htmlspecialchars($_POST['zipcode']);
         } else {
            $formErrors['zipCode'] = 'Veuillez saisir un code postal valide';
         }
      } else {
         $formErrors['zipCode'] = 'Veuillez renseigner votre code postal';
      }
//Comme plusieurs villes peuvent avoir le même code postal je ne stocke dans l'objet 
//que celle qui correspont à la ville sélectionné et non pas au code postal saisie
      if (!empty($_POST['city'])) {
         if (preg_match($regexSearch, $_POST['city'])) {
            $user->idCity = htmlspecialchars($_POST['city']);
         } else {
            $formErrors['city'] = 'Veuillez saisir un code postal';
         }
      } else {
         $formErrors['city'] = 'Veuillez saisir un code postal et choisir la ville corrspondante';
      }
//vérification du numéro de téléphone
      if (!empty($_POST['phoneNumber'])) {
         if (preg_match($regexPhoneNumber, $_POST['phoneNumber'])) {
            $user->phoneNumber = htmlspecialchars($_POST['phoneNumber']);
         } else {
            $formErrors['phoneNumber'] = 'Veuillez saisir un numéro de téléphone valide';
         }
      } else {
         $formErrors['phoneNumber'] = 'Veuillez renseigner votre numéro de téléphone';
      }

//Vérifié avec filter var à la place regexMail
      if (!empty($_POST['mail'])) {
         if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $user->mail = htmlspecialchars($_POST['mail']);
            /**
             * Je vérifie si l'utilisateur existe dans la base de données
             * On stocke le résultat de la méthode checkUserExist qui permet de vérifier
             * si l'adresse mail (login) de l'utilisateur a déjà été enregistré dans la base de donnée
             */
            $resultCount = $user->checkUserExist();
            if ($resultCount->count > 0) {
               $formErrors['mail'] = 'Un compte avec ce mail existe déjà. Veuillez modifier l\'adresse mail';
            }
         } else {
            $formErrors['mail'] = 'Veuillez saisir une adresse mail valide';
         }
      } else {
         $formErrors['mail'] = 'Veuillez renseigner votre adresse mail';
      }
//vérification du mot de passe
      if (!empty($_POST['password'])) {
         if ($_POST['password'] == $_POST['confirmPassword']) {
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
         } else {
            $formErrors['password'] = 'Les deux mot de passe ne correspondent pas';
         }
      } else {
         $formErrors['password'] = 'Veuillez entrer un mot de passe';
      }



      /**
       * Vérification de la saisie du formulaire dans le cas où le rôle choisit est commerçant 
       * et donc que $_POST['role']=23
       * J'instancie la classe siren qui me permettra de faire à une méthode pour accéder aux numéros de siren sur la ville de noyon
       */
      if (isset($_POST['role']) && $_POST['role'] == 23) {

//         //vérification des valeurs saisis dans le champs Siren 
         if (!empty($_POST['siren'])) {
            if (preg_match($regexSiren, $_POST['siren'])) {
               //Je stocke le résultat dans une variable 
               $siren = htmlspecialchars($_POST['siren']);
            } else {
               $formErrors['siren'] = 'Veuillez saisir un numéro de SIREN valide';
            }
         } else {
            $formErrors['siren'] = 'Veuillez renseigner votre numéro de SIREN';
         }
         /**
          * Vérification du nom du commerce
          * J'instancie la classe store afin de pouvoir utiliser ses attributs
          */
         if (!empty($_POST['name'])) {
            if (preg_match($regexSearch, $_POST['name'])) {
               //Je stocke le résultat dans une variable 
               $store->idSiren = htmlspecialchars($_POST['name']);
            } else {
               $formErrors['name'] = 'Veuillez saisir un numéro de SIREN valide ou complet';
            }
         } else {
            $formErrors['name'] = 'Veuillez renseigner votre numéro de SIREN';
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
//         //Vérification du fichier en upload
//         if (isset($_FILES['file'])) {
//            $target_dir = 'uploads/' . date('Y-m-d_H-i-s') . $_FILES['file']['name'];
//
//            $uploadOk = 1;
//            $imageFileType = strtolower(pathinfo($target_dir, PATHINFO_EXTENSION));
////Vérifie si le fichier image est une image réelle ou une image factice
//            if (count($_FILES)) {
//               $check = getimagesize($_FILES['file']['tmp_name']);
//               if ($check != false) {
//                  $formErrors['file'] = 'Le fichier est une image - ' . $check['mime'] . '';
//                  $uploadOk = 1;
//               } else {
//                  $formErrors['file'] = 'Votre fichier n\'est pas du format attendu';
//                  $uploadOk = 0;
//               }
//            }
//// Vérifie si le fichier existe déjà
//            if (file_exists($target_dir)) {
//               $formErrors['file'] = 'Désolé, le fichier existe déjà.';
//               $uploadOk = 0;
//            }
//// Vérifie la taille du fichier
//            if ($_FILES['file']['size'] > 5000000) {
//               $formErrors['file'] = 'Désolé, votre fichier est trop volumineux.';
//               $uploadOk = 0;
//            }
//// Autoriser certains formats de fichier
//            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
//               $formErrors['file'] = 'Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.';
//               $uploadOk = 0;
//            }
//// Vérifie si $ uploadOk est défini sur 0 par une erreur
//            if ($uploadOk == 0) {
//               $formErrors['img'] = 'Désolé, votre fichier n\'a pas été téléchargé.';
//            } else {
//               if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir)) {
//                  chmod($target_dir, 0777);
//                  $store->photo = basename($_FILES['file']['name']);
//               } else {
//                  $formErrors['file'] = 'Désolé, une erreur s\'est produite lors de l\'envoi de votre fichier.';
//               }
//            }
//         }
      }

      if ($_POST['role'] == 24) {


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
               $formErrors['service'] = 'Veuillez saisir un nom de service ';
            }
         } else {
            $formErrors['service'] = 'Veuillez renseigner un nom de service';
         }

         if (!empty($_POST['phoneNumberService'])) {
            if (preg_match($regexPhoneNumber, $_POST['phoneNumberService'])) {
               $organization->phoneNumberOffice = htmlspecialchars($_POST['phoneNumberService']);
            } else {
               
            }
         } else {
            $formErrors['phoneNumberService'] = 'Veuillez renseigner un nom de poste';
         }

         if (!empty($_POST['sirenCity'])) {
            if (preg_match($regexSearch, $_POST['sirenCity'])) {
               $sirenCity = htmlspecialchars($_POST['sirenCity']);
            } else {
               $formErrors['sirenCity'] = 'Veuillez saisir un nom de poste';
            }
         } else {
            $formErrors['sirenCity'] = 'Veuillez renseigner un nom de poste';
         }

         if (!empty($_POST['nameEpci'])) {
            if (preg_match($regexSearch, $_POST['nameEpci'])) {
               $organization->idCommunity = htmlspecialchars($_POST['nameEpci']);
            } else {
               $formErrors['nameEpci'] = 'Veuillez saisir un nom de poste';
            }
         } else {
            $formErrors['nameEpci'] = 'Veuillez renseigner un nom de poste';
         }
      }
   }

   /**
    * Vérification de la saisie du formulaire dans le cas où le rôle choisit est responsable 
    * et donc que $_POST['role']=24
    */
//   On vérifie s'il n'y a pas d'erreurs dans le tableau (formErrors)
//   et on vérife que le résultat (resultCount) de la méthode chekUserExist est égal à 0
//   ce qui veut dire que l'adresse mail n'existe pas en base de donnée
   //Si la comptabilisation du tableau d'erreur est égale à 0
//   
   if (count($formErrors) == 0) {
      if (isset($_POST['role']) && $_POST['role'] == 22) {
         $user->createUser();
         $formSuccess = 'Votre compte utilisateur a été crée avec succès. Vous pouvez à présent vous connecter';
      }
      if (isset($_POST['role']) && $_POST['role'] == 24) {
         try {
            $user->beginTransaction();
            $user->createUser();
            $organization->idUsers = $user->lastInsertId();
            $organization->createService();
            $organization->commit();
            $formSuccess = 'L\'utilisateur et la ville ont été crée';
         } catch (Exception $ex) {
            $organization->rollback();
            $formErrors['transaction'] = 'Veuillez nous excuser ';
            die('Error : ' . $ex);
         }
      }
      if ((isset($successDoc)) && $successDoc === true) {
         if (isset($_POST['role']) && $_POST['role'] == 23) {      
            $target_dir = time().'.'.$fileExtend;
            $store->photo = htmlspecialchars($target_dir);
            move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . basename($store->photo));
              chmod('uploads/' . basename($store->photo), 0755);
            try {
               $user->beginTransaction();
               $user->createUser();
               $store->idUsers = $user->lastInsertId();
               $store->createStore();
               $store->commit();
               $formSuccess = 'Votre inscription a bien été pris en compte, vous pouvez vous connecter.';
            } catch (Exception $ex) {
               $organization->rollback();
               $formErrors['transaction'] = 'Veuillez nous excuser, votre incription n\'a pas abouti. ';
               die('Error : ' . $ex);
            }
         }
      }
   }
}
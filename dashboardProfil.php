<?php
session_start();
require 'controllers/dashboardUserCtrl.php';
$titlePage = 'Dashboard - Profil ';
require 'includes/header.php';
require 'includes/navbarlogout.php';
?>
<section>


   <?php
   /**
    * Affichage de la variable de succès ou de la variable d'erreur dans des alertes
    */
   if (isset($deleteSuccess)) {
      ?>
      <div class="alert alert-success" role="alert">
         <?= $deleteSuccess ?>
      </div>  
      <?php
   } else if (isset($deleteError)) {
      ?>
      <div class="alert alert-danger" role="alert">
         <?= $deleteError ?>
      </div>  
      <?php
   }
   ?>
   <div class="row mt-4">
      <div class="col-4">
         <!--            navbar vertical -->
         <?php
         include 'includes/navbar_vertical_dashboard.php';
         ?>
      </div>
      <div class="col-6">
         <div class="card mb-2 mt-2">
            <div class="card-header-pills">
               <h1 class="card-text text-center">Mon profil</h1>
            </div>
            <div class="card-body">
               <div class="jumbotron">
                  <!-- 
Fenêtre modale pour la confirmation de la suppresion du compte
Elle prend l'attribut data-id qui permettra l'ouverture de ma modale.
on ne mets rien dans le footer de la modale car je vais créer un bouton à l'aide du javascript
                  -->
                  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class=" modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="mainDelete"></div>
                           </div>
                           <div class="modal-footer"></div>
                        </div>
                     </div>
                  </div>
                  <p><?= $infoUser->civility . ' ' . $infoUser->firstname . ' ' . $infoUser->lastname ?> </p>
                  <hr />
                  <p><i class="fas fa-address-card"></i><span class="font-weight-bold"> Adresse : </span><?= $infoUser->adresse . ' ' . $infoUser->zipcode . ' ' . $infoUser->city ?> </p>
                  <hr />
                  <p><i class="fas fa-mobile-alt"></i> <span class="font-weight-bold"> Numéro de téléphone :</span> <?= $infoUser->phonenumber ?></p>
                  <hr />
                  <p> <i class="fas fa-at"></i><span class="font-weight-bold"> Courriel :</span> <?= $infoUser->mail ?></p>
               </div>
               <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formUpdate" role="button" aria-expanded="false" aria-controls="formUpdate">
                  Modifier
               </button>
               <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="<?= $infoUser->id ?>" data-lastname="<?= $infoUser->lastname ?>" data-firstname="<?= $infoUser->firstname ?>">Supprimer mon compte</button>
            </div>
            <div  class="collapse" id="formUpdate">
               <div class="card-footer">
                  <?php if (count($_POST) == 0 || count($formErrors) > 0) { ?>
                     <form action="" name="updateProfil" method="POST">

                        <div class="form-group">
                           <label for="firstname">Prénom :</label>
                           <input type="text" name="firstname" value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['firstname']) : $infoUser->firstname ?>" class="form-control <?= isset($formErrors['firstname']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" id="firstname" />
                           <?php if (isset($formErrors['firstname'])) { ?>
                              <div class="alert alert-danger mt-2" role="alert"><?= $formErrors['firstname'] ?> </div>
                           <?php } ?>
                        </div>
                        <div class="form-group">
                           <label for="lastname">Nom :</label>
                           <input type="text" name="lastname" value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['lastname']) : $infoUser->lastname ?>" class="form-control <?= isset($formErrors['lastname']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" id="lastname" />
                           <?php if (isset($formErrors['lastname'])) { ?>
                              <div class="alert alert-danger mt-2" role="alert"><?= $formErrors['lastname'] ?> </div>
                           <?php } ?>
                        </div>
                        <div class="form-group row">
                           <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                              <label for="phonenumber"> Numéro de téléphone </label>
                              <input type="text" name="phonenumber" class="form-control <?= isset($formErrors['phonenumber']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" id="phonenumber"  value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['phonenumber']) : $infoUser->phonenumber ?>"placeholder="01 02 03 04 05" />
                              <?php
                              if (isset($formErrors['phonenumber'])) {
                                 ?>
                                 <div class="invalid-feedback">
                                    <div class="alert alert-danger mt-2" role="alert"><?= $formErrors['phonenumber'] ?></div>
                                 </div>
                              <?php } ?>
                           </div>
                           <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                              <label for="mail">Adresse mail</label>
                              <input type="email"  class="form-control  <?= isset($formErrors['mail']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="mail" value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['mail']) : $infoUser->mail ?>" id="mail" aria-describedby="emailHelp" placeholder="Jean.dupont@example.fr" />
                              <small id="emailHelp" class="form-text text-muted">Votre adresse mail servira à vous connecter en tant que membre.</small>
                              <?php
                              if (isset($formErrors['mail'])) {
                                 ?>
                                 <div class="invalid-feedback">
                                    <div class="alert alert-danger mt-2" role="alert"><?= $formErrors['mail'] ?></div>
                                 </div>
                              <?php } ?>
                           </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Valider</button>
                     </form>
                     <?php
                  } else {
                     if (isset($formSuccess)) {
                        ?>
                        <div class="row mb-3 mt-3">
                           <div class="col-12 alert alert-success " role="alert">
                              <div class="alert alert-success mt-2" role="alert"><?= $formSuccess; ?></div>
                           <?php } ?> 
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </section>
         <?php require 'includes/footer.php'; ?>


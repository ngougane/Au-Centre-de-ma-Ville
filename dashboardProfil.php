<?php
require_once 'controllers/dashboardProfilCtrl.php';
$titlePage = 'Dashboard - Profil ';
require 'includes/header.php';
require 'includes/navbarlogout.php';
var_dump($infoStore);
?>
<section>

   <div class="row mt-4">
      <div class="col-3">
         <!--            navbar vertical -->
         <?php
         include 'includes/navbar_vertical_dashboard.php';
         ?>
      </div>
      <div class="col-8">
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
                              <div class="mainDelete">
                                 
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
                              </div>
                           </div>
                           <div class="modal-footer"></div>
                        </div>
                     </div>
                  </div>
                  <?php // Affichage des infos user ?>
                  <div class="row">
                     <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h2>Vos Informations personnelles</h2> 
                     </div> 
                  </div>
                  <div class="row">
                     <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <p><?= $infoUser->civility . ' ' . $infoUser->firstname . ' ' . $infoUser->lastname ?> </p>
                        <hr />
                        <p><i class="fas fa-address-card"></i><span class="font-weight-bold"> Adresse : </span><?= $infoUser->adresse . ' ' . $infoUser->zipcode . ' ' . $infoUser->city ?> </p>       
                        <p><i class="fas fa-mobile-alt"></i> <span class="font-weight-bold"> Numéro de téléphone :</span> <?= $infoUser->phoneNumber ?></p>              
                        <p> <i class="fas fa-at"></i><span class="font-weight-bold"> Courriel :</span> <?= $infoUser->mail ?></p>
                     </div> 
                  </div>

                  <?php
                  // Affichage des infos du profil commerçant
                  if ((isset($_SESSION['role'])) && ($_SESSION['role']) == 23) {
                     ?>
                     <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                        </div> 
                     </div>
                     <hr />
                     <h3>Les informations de votre commerce</h3>
                     <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                           <img src="uploads/<?= $infoStore->photo ?>" class="img-thumbnail rounded"/>
                        </div>
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                           <p><span class="font-weight-bold"> Raison Sociale : </span> <?= $infoStore->raisonSociale ?></p>
                           <p><span class="font-weight-bold"> Type d'activité : </span> <?= $infoStore->activity ?></p>
                           <p><span class="font-weight-bold"> Adresse : </span> <?= $infoStore->adresse ?></p>
                           <p><span class="font-weight-bold"> Code postal : </span> <?= $infoStore->zipCode ?></p>
                           <p><span class="font-weight-bold"> Ville : </span> <?= $infoStore->city ?></p>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                           <p><span class="font-weight-bold"> Les horaires d'ouvertures :  </span> <?= $infoStore->openingTime ?></p>
                        </div>
                     </div>
                  <?php
                  }
                  // Affichage des infos du profil responsable 
                  if ((isset($_SESSION['role'])) && ($_SESSION['role']) == 24) {
                     ?>
                      <div class="row">
                         <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <h3>Les informations concernant votre secteur d'affiliation</h3>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                           <hr />
                     <p><span class="font-weight-bold"> Poste : </span> <?= $infoService->jobTitle ?></p>
                     <p><span class="font-weight-bold"> Structure de rattachement :</span> <?= $infoService->service ?></p>
                     <p><i class="fas fa-mobile-alt"></i> <span class="font-weight-bold"> Contact bureau :</span> <?= $infoService->phoneNumberOffice ?></p>
                     <hr />
                     <p><span class="font-weight-bold"> Ville :</span> <?= $infoService->nameCity ?></p>
                     <p><span class="font-weight-bold"> Communauté de communes :</span> <?= $infoService->nameEPCI ?></p>
                     <p><span class="font-weight-bold"> Département  :</span> <?= $infoService->departementEPCI ?></p>
                         </div>
                      </div>
<?php }
?>
               </div>
               <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formUpdate" role="button" aria-expanded="false" aria-controls="formUpdate">
                  Modifier
               </button>
               <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="<?= $infoUser->id ?>" data-lastname="<?= $infoUser->lastname ?>" data-firstname="<?= $infoUser->firstname ?>">Supprimer mon compte</button>
            </div>
            <div  class="collapse" id="formUpdate">
               <div class="card-footer">
<?php if (count($_POST) == 0 || count($formErrors) > 0) { ?>
                     <form action="" name="updateProfil" method="POST" enctype="multipart/form-data">

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
                              <label for="phoneNumber"> Numéro de téléphone </label>
                              <input type="text" name="phoneNumber" class="form-control <?= isset($formErrors['phoneNumber']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" id="phoneNumber"  value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['phoneNumber']) : $infoUser->phoneNumber ?>"placeholder="01 02 03 04 05" />
                              <?php
                              if (isset($formErrors['phoneNumber'])) {
                                 ?>
                                 <div class="invalid-feedback">
                                    <div class="alert alert-danger mt-2" role="alert"><?= $formErrors['phoneNumber'] ?></div>
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

   <?php if ((isset($_SESSION['role'])) && ($_SESSION['role']) == 23) {
      ?>
                 <div class="form-group row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                     <div>
                        <label for="file" >Sélectionner une photo</label>
                        <input type="file" class="form-control" name="file" id="file" />                    
                     </div>
                  </div>
                  <?php if (isset($formErrors['file'])) { ?>
                     <div class="alert alert-danger" role="alert">
                        <p><?= $formErrors['file'] ?></p>
                     </div>
                  <?php } ?>
             
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                     <label for="openingTime">Vos horaires d'ouverture</label>
                     <input type="text"   class="form-control  <?= isset($formErrors['openingTime']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="openingTime" value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['openingTime']) : $infoStore->openingTime ?>" id="openingTime" placeholder="Du lundi au vendredi de 9h à 18h" />
                     <?php
                     if (isset($formErrors['openingTime'])) {
                        ?>
                        <div class="invalid-feedback alert alert-danger" role="alert">
                           <p><?= $formErrors['openingTime'] ?></p>
                        </div>
                     <?php } ?>
                  </div>
                      </div>
                        <?php
   }
      ?>
   <?php if ((isset($_SESSION['role'])) && ($_SESSION['role']) == 24) {
      ?>
                           <div class="form-group row">
                              <div class="col-12 col-sm-6 col-md-6 col-lg-6">

                                 <label for="jobTitle">Intitulé de votre poste</label>
                                 <input type="text"  class="form-control  <?= isset($formErrors['jobTitle']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="jobTitle" value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['jobTitle']) : $infoService->jobTitle ?>" id="jobTitle" placeholder="Manager centre ville" />
                                 <?php
                                 if (isset($formErrors['jobTitle'])) {
                                    ?>
                                    <div class="invalid-feedback alert alert-danger" role="alert">
                                       <p><?= $formErrors['jobTitle'] ?></p>
                                    </div>
      <?php } ?>
                              </div>
                              <div class="col-12 col-sm-6 col-md-6 col-lg-6">

                                 <label for="service">Service</label>
                                 <input type="text"  class="form-control  <?= isset($formErrors['service']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="service" value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['service']) : $infoService->service ?>" id="service" placeholder="Pôle Economie"  />
                                 <?php
                                 if (isset($formErrors['service'])) {
                                    ?>
                                    <div class="invalid-feedback alert alert-danger" role="alert">
                                       <p><?= $formErrors['service'] ?></p>
                                    </div>
      <?php } ?>
                              </div>
                           </div>
                           <div class="form-group row">
                              <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                 <label for="phoneNumberService">Numéro de téléphone de votre bureau</label>
                                 <input type="text"  class="form-control  <?= isset($formErrors['phoneNumberService']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="phoneNumberService" value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['phoneNumberService']) : $infoService->phoneNumberOffice ?>" id="phoneNumberService" placeholder="01 01 01 01 01" />
                                 <?php
                                 if (isset($formErrors['phoneNumberService'])) {
                                    ?>
                                    <div class="invalid-feedback alert alert-danger" role="alert">
                                       <p><?= $formErrors['phoneNumberService'] ?></p>
                                    </div>
                           <?php } ?>
                              </div>
                           </div>
   <?php }
   ?>

                        <button class="btn btn-primary" type="submit">Valider</button>
                     </form>
                     <?php
                  } else {
                     if (isset($formSuccess)) {
                        ?>
                        <div class="row mb-3 mt-3">
                           <div class="col-12 alert alert-success " role="alert">
                              <div class="alert alert-success mt-2" role="alert"><?= $formSuccess; ?></div>
   <?php } else { ?>
                              <div class="row mb-3 mt-3">
                                 <div class="col-12 alert alert-success " role="alert">
                                    <div class="alert alert-success mt-2" role="alert"><?= $formErrors['results']; ?></div>
   <?php } ?> 
<?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               </section>
<?php require 'includes/footer.php'; ?>


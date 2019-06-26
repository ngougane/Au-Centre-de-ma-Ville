<?php
 require 'modalLogin.php';
require 'controllers/usersRegisterCtrl.php';
$titlePage = "Inscription - Au Centre de ma ville";
require 'includes/header.php';

var_dump($_POST);
?>

<section>
   <div class="container">
      <?php if (count($_POST) == 0 || !empty($formErrors)) { ?>
         <form action="register.php" method="POST" enctype="multipart/form-data">
            <h1 class="mt-3 text-center">Votre Inscription</h1>
            <hr />
            <div class="form-group row">
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group">
                     <legend>Vous êtes ? </legend>
                     <?php
                     /*
                      * ROLE
                      * La boucle foreach permettra d'afficher
                      * Pour garder la saisie utilisateur, on ajoute l'attribut checked s'il a coché l'input
                      */
                     foreach ($listroles as $role) {
                        ?>
                        <div class="form-check form-check-inline">
                           <input type="radio" id="<?= $role->id ?>" name="role" value="<?= $role->id ?>" <?= isset($_POST['role']) && $_POST['role'] == $role->id ? 'checked' : '' ?> class="form-check-input <?= isset($formErrors['role']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>">
                           <label class="form-check-label" for="<?= $role->id ?>"><?= $role->name ?></label>
                        </div>
                        <?php
                     }
                     if (isset($formErrors['role'])) {
                        ?>
                        <div class="invalid-feedback d-block "><?= $formErrors['role'] ?></div>
                     <?php } ?>
                  </div>
               </div>


               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group">
                     <legend>Civilité</legend>
                     <?php
                     /*
                      * La boucle foreach permettra d'afficher
                      * Pour garder la saisie utilisateur, on ajoute l'attribut checked s'il a coché l'input
                      */
                     foreach ($listcivility as $civility) {
                        ?>
                        <div class="form-check form-check-inline">
                           <input type="radio" id="roleYes" name="civility" value="<?= $civility->id ?>" <?= isset($_POST['civility']) && $_POST['civility'] == $civility->id ? 'checked' : '' ?> class="form-check-input <?= isset($formErrors['civility']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>">
                           <label class="form-check-label" for="roleYes"><?= $civility->civility ?></label>
                        </div>
                        <?php
                     }

                     if (isset($formErrors['civility'])) {
                        ?>
                        <div class="invalid-feedback d-block"><?= $formErrors['civility'] ?></div>
                     <?php } ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="firstname">Prénom</label>
                  <input type="text" required  class="form-control <?= isset($formErrors['firstname']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="firstname" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" id="firstname" placeholder="Jean" />
                  <?php
                  if (isset($formErrors['firstname'])) {
                     ?>
                     <div class="invalid-feedback alert alert-danger" role="alert">
                        <p><?= $formErrors['firstname'] ?></p>
                     </div>
                  <?php } ?>
               </div>
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="lastname">Nom</label>
                  <input type="text" required class="form-control <?= isset($formErrors['lastname']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="lastname" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" id="lastname" placeholder="Dupont" />
                  <?php
                  if (isset($formErrors['lastname'])) {
                     ?>
                     <div class="invalid-feedback alert alert-danger" role="alert">
                        <p><?= $formErrors['lastname'] ?></p>
                     </div>
                  <?php } ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <label for="address">Adresse</label>
                  <?php
                  /*
                   * Pour afficher ce qu'a saisi l'utilisateur, on le place entre les balises ouvrantes et fermantes du textarea
                   * Le textarea n'a pas d'attribut value
                   */
                  ?>
                  <input type="text" required name="address"  class="form-control <?= isset($formErrors['address']) ? 'is-invalid' : (isset($address) ? 'is-valid' : '') ?>" id="address" rows="2" placeholder="55 rue du Havre" value = "<?= isset($_POST['address']) ? $_POST['address'] : '' ?>" />
                  <?php if (isset($formErrors['address'])) { ?>
                     <div class="invalid-feedback alert alert-danger" role="alert"><?= $formErrors['address'] ?></div>
                  <?php } ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="zipcode">Code Postal</label>
                  <input type="text" name="zipcode" id="search" class="form-control" placeholder="60200" value="<?= isset($zipcode) ? $zipcode : '' ?>" required>
                  <?php
                  if (isset($formErrors['zipcode'])) {
                     ?>
                     <div class="invalid-feedback alert alert-danger" role="alert">
                        <p><?= $formErrors['zipcode'] ?></p>
                     </div>
                  <?php } ?>
               </div>
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="city">Ville</label>
                  <select name="city" id="city" class="form-control">
                     <option selected disabled>Saisir votre code postal</option>
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="phoneNumber"> Numéro de téléphone </label>
                  <input type="text" required name="phoneNumber" class="form-control <?= isset($formErrors['phoneNumber']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" id="phoneNumber"  value="<?= isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '' ?>" placeholder="01 02 03 04 05" />
                  <?php
                  if (isset($formErrors['phoneNumber'])) {
                     ?>
                     <div class="invalid-feedback alert alert-danger" role="alert">
                        <p><?= $formErrors['phoneNumber'] ?></p>
                     </div>
                  <?php } ?>
               </div>
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="mail">Adresse mail</label>
                  <input type="email" required  class="form-control  <?= isset($formErrors['mail']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="mail" value="<?= isset($_POST['mail']) ? $_POST['mail'] : '' ?>" id="mail" aria-describedby="emailHelp" placeholder="Jean.dupont@example.fr" />
                  <small id="emailHelp" class="form-text text-muted">Votre adresse mail servira à vous connecter en tant que membre.</small>
                  <?php
                  if (isset($formErrors['mail'])) {
                     ?>
                     <div class="invalid-feedback alert alert-danger" role="alert">
                        <p><?= $formErrors['mail'] ?></p>
                     </div>
                  <?php } ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="password">Mot de passe</label>
                  <input type="password" required  class="form-control  <?= isset($formErrors['password']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="password" value="" id="password" placeholder="Mot de passe" />
                  <?php
                  if (isset($formErrors['password'])) {
                     ?>
                     <div class="invalid-feedback alert alert-danger" role="alert">
                        <p><?= $formErrors['password'] ?></p>
                     </div>
                  <?php } ?>
               </div>
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="confirmPassword">Confirmer votre mot de passe</label>
                  <input type="password" required class="form-control" name="confirmPassword" value="" id="confirmPassword" placeholder="Confirmez!" />
               </div>
            </div>

            <!-- Commerçant -->
            <div id="tradeInfo">
               <legend>Commerçant</legend>
               <div class="form-group row mb-3">
                  <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                     <label for="sirenSearch">Numéro SIREN</label>
                     <input type="text"  class="form-control  <?= isset($formErrors['siren']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="siren" value="" id="sirenSearch" placeholder="2546215" />
                     <?php
                     if (isset($formErrors['siren'])) {
                        ?>
                        <div class="invalid-feedback alert alert-danger" role="alert">
                           <p><?= $formErrors['siret'] ?></p>
                        </div>
                     <?php } ?>
                  </div>
                  <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                     <!--                     <legend>Créer la fiche de votre commerce</legend>-->
                     <label for="name">Nom du commerce</label>
                     <select name="name" id="name" class="form-control <?= isset($formErrors['name']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>">
                        <option selected disabled>Saisir votre SIREN</option>
                     </select>
                     <?php
                     if (isset($formErrors['name'])) {
                        ?>
                        <div class="invalid-feedback alert alert-danger" role="alert">
                           <p><?= $formErrors['name'] ?></p>
                        </div>
                     <?php } ?>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                     <label for="activity">Activité</label>
                     <select name="activity" id="activity" class="form-control <?= isset($formErrors['activity']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>">
                        <option selected disabled>Saisir votre SIREN</option>
                     </select>
                     <?php
                     if (isset($formErrors['activity'])) {
                        ?>
                        <div class="invalid-feedback alert alert-danger" role="alert">
                           <p><?= $formErrors['activity'] ?></p>
                        </div>
                     <?php } ?>
                  </div>
                  <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                     <label for="openingTime">Vos horaires d'ouverture</label>
                     <input type="text"   class="form-control  <?= isset($formErrors['openingTime']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="openingTime" value="<?= isset($_POST['openingTime']) ? $_POST['openingTime'] : '' ?>" id="openingTime" placeholder="Du lundi au vendredi de 9h à 18h" />
                     <?php
                     if (isset($formErrors['openingTime'])) {
                        ?>
                        <div class="invalid-feedback alert alert-danger" role="alert">
                           <p><?= $formErrors['openingTime'] ?></p>
                        </div>
                     <?php } ?>
                  </div>

               </div>
               <div class="form-group row">
                  <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                     <div>
                        <label for="file" >Photo de votre commerce</label>
                        <input type="file" class="form-control  <?= isset($formErrors['file']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="file" id="file" />
                     </div>
                  </div>
                  <?php if (isset($formErrors['file'])) { ?>
                     <div class="alert alert-danger" role="alert">
                        <p><?= $formErrors['file'] ?></p>
                     </div>
                  <?php } ?>
               </div>
            </div>

            <!--               Responsable -->
            <div id="responsableInfo">
               <div class="form-group row">
                  <legend>Responsable de la redynamisation de la ville</legend>

                  <div class="col-12 col-sm-6 col-md-6 col-lg-6">

                     <label for="jobTitle">Intitulé de votre poste</label>
                     <input type="text"  class="form-control  <?= isset($formErrors['jobTitle']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="jobTitle"  value="<?= isset($_POST['jobTitle']) ? $_POST['jobTitle'] : '' ?>" id="jobTitle" placeholder="Manager centre ville" />
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
                     <input type="text"  class="form-control  <?= isset($formErrors['service']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="service"  value="<?= isset($_POST['service']) ? $_POST['service'] : '' ?>" id="service" placeholder="Pôle Economie" />
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
                     <input type="text"  class="form-control  <?= isset($formErrors['phoneNumberService']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="phoneNumberService"  value="<?= isset($_POST['phoneNumberService']) ? $_POST['phoneNumberService'] : '' ?>" id="phoneNumberService" placeholder="03 02 02 02 05" />
                     <?php
                     if (isset($formErrors['phoneNumberService'])) {
                        ?>
                        <div class="invalid-feedback alert alert-danger" role="alert">
                           <p><?= $formErrors['phoneNumberService'] ?></p>
                        </div>
                     <?php } ?>
                  </div>
                  <div class="col-12 col-sm-6 col-md-6 col-lg-6">

                     <label for="sirenCity">SIREN de votre commune</label>
                     <input type="text"  class="form-control  <?= isset($formErrors['sirenCity']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="sirenCity" value="<?= isset($_POST['sirenCity']) ? $_POST['sirenCity'] : '' ?>" id="sirenCitySearch" placeholder="2546215" />
                     <?php
                     if (isset($formErrors['sirenCity'])) {
                        ?>
                        <div class="invalid-feedback alert alert-danger" role="alert">
                           <p><?= $formErrors['sirenCity'] ?></p>
                        </div>
                     <?php } ?>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-12 col-sm-6 col-md-6 col-lg-6">

                     <label for="sirenEpci">SIREN EPCI</label>
                     <select name="sirenEpci" id="sirenEpci" class="form-control">
                        <option selected disabled>Saisir le SIREN de votre commune</option>
                     </select>
                     <?php
                     if (isset($formErrors['sirenEpci'])) {
                        ?>
                        <div class="invalid-feedback alert alert-danger" role="alert">
                           <p><?= $formErrors['sirenEpci'] ?></p>
                        </div>
                     <?php } ?>
                  </div>
                  <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                     <label for="nameEpci">Nom de votre commune</label>
                     <select name="nameEpci" id="nameEpci" class="form-control">
                        <option selected disabled>Saisir le SIREN de votre commune</option>
                     </select>
                     <?php
                     if (isset($formErrors['nameEpci'])) {
                        ?>
                        <div class="invalid-feedback alert alert-danger" role="alert">
                           <p><?= $formErrors['nameEpci'] ?></p>
                        </div>
                     <?php } ?>
                  </div>
               </div>

            </div>

            <div class="form-group row mb-3">
               <div class="form-check form-check-inline ">
                  <input type="checkbox" class="form-check-input" value="yes" id="invalidCheck" required />
                  <label for="invalidCheck" class="form-check-label">J'accepte  <a href="#">les conditions d'utilisations </a></label>
                  <div class="invalid-feedback">Vous devez accepter les conditions d'utilisations</div>
               </div>
               <input type="submit" class="btn btn-primary" name="checkForm"  value="Valider"/>
            </div>

         </form>
         <a  class="mb-2" href="index.php">Retour à l'acceuil</a>
         <?php
      } else {
         if (isset($formSuccess)) {
            ?>
            <div class="row mb-3 mt-3">
               <div class="col-12 alert alert-success " role="alert">
                  <p><?= $formSuccess; ?></p>
                  <a href="#" class='btn btn-primary' data-toggle="modal" data-target="#loginModal"><span><i class="fas fa-user"></i> </span>Se connecter</a>
                  <div class="row">
                    
                  </div>
                  <?php
               } else {
                  ?>
                  <div class="alert alert-danger" role='alert'>
                     <p><?= !empty($formErrors['create']) ? $formErrors['create'] : '' ?></p>
                  </div>
                  <?php
               }
               ?>
            </div>
         </div>
      <?php } ?>

   </div>
</section>
<?php require_once 'includes/footer.php' ?>
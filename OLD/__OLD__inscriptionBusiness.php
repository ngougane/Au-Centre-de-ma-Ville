<?php
$titlePage = " Inscription - Au Centre de ma ville";
require 'includes/header.php';
?>
<section>
   <div class="container">
      <?php if (count($_POST) == 0 || count($formErrors) > 0) { ?>
         <form name="addUser" action="inscription.php" method="POST">
            <fieldset>Profil </fieldset>
            <hr />
            <legend>Vous êtes ? </legend>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="typeUser" id="classicUser" value="1" checked />
                     <label class="form-check-label" for="classicUser">
                        Un particulier 
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="typeUser" id="trader" value="2" />
                     <label class="form-check-label" for="trader">
                        Un commerçant 
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="typeUser" id="responsible" value="3" />
                     <label class="form-check-label" for="responsible">
                        Un responsable de la redynamisation de la ville 
                     </label>
                  </div>
               </div>
            </div>
            <fieldset>Vos informations</fieldset>
            <hr />
            <legend>Civilité</legend>
            <div class="form-group row">
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="form-check-inline">
                     <input class="form-check-input" type="radio" name="civility" id="madame" value="1" checked />
                     <label class="form-check-label" for="madame">
                        Madame
                     </label>
                  </div>
                  <div class="form-check-inline">
                     <input class="form-check-input" type="radio" name="civility" id="mister" value="2" />
                     <label class="form-check-label" for="mister">
                        Monsieur
                     </label>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="firstname">Prénom</label>
                  <input type="text" required  class="form-control" name="firstname" value="" id="firstname" placeholder="Jean" />
                  <?php
                  if (isset($formErrors['firstname'])) {
                     ?>
                     <div class="invalid-feedback">
                        <p><?= $formErrors['firstname'] ?></p>
                     </div>
                  <?php } ?>
               </div>
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="lastname">Nom</label>
                  <input type="text" required class="form-control" name="lastname" value="" id="lastname" placeholder="Dupont" />
                  <?php
                  if (isset($formErrors['lastname'])) {
                     ?>
                     <div class="invalid-feedback">
                        <p><?= $formErrors['lastname'] ?></p>
                     </div>
                  <?php } ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="zipcode">Code Postal</label>
                  <input type="text" required  class="form-control" name="zipcode" value="" id="zipcode" placeholder="60200" />
                  <?php
                  if (isset($formErrors['zipcode'])) {
                     ?>
                     <div class="invalid-feedback">
                        <p><?= $formErrors['zipcode'] ?></p>
                     </div>
                  <?php } ?>
               </div>
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="city">Ville</label>
                  <input type="text" required class="form-control" name="city" value="" id="city" placeholder="Compiègne" />
                  <?php
                  if (isset($formErrors['city'])) {
                     ?>
                     <div class="invalid-feedback">
                        <p><?= $formErrors['city'] ?></p>
                     </div>
                  <?php } ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="phonenumber"> Numéro de téléphone </label>
                  <input type="text" required name="phonenumber" value="" class="form-control" id="phonenumber" placeholder="01 02 03 04 05" />
                  <?php
                  if (isset($formErrors['phonenumber'])) {
                     ?>
                     <div class="invalid-feedback">
                        <p><?= $formErrors['phonenumber'] ?></p>
                     </div>
                  <?php } ?>
               </div>
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="mail">Adresse mail</label>
                  <input type="email" required  class="form-control" name="mail" value="" id="mail" aria-describedby="emailHelp" placeholder="Jean.dupont@example.fr" />
                  <small id="emailHelp" class="form-text text-muted">Votre adresse mail servira à vous connecter en tant que membre.</small>
                  <?php
                                if (isset($formErrors['mail'])) {
                                    ?>
                                    <div class="invalid-feedback">
                                        <p><?= $formErrors['mail'] ?></p>
                                    </div>
                                <?php } ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="password">Mot de passe</label>
                  <input type="password" required  class="form-control" name="password" value="" id="password" placeholder="Mot de passe" />
                  <?php
                                if (isset($formErrors['password'])) {
                                    ?>
                                    <div class="invalid-feedback">
                                        <p><?= $formErrors['password'] ?></p>
                                    </div>
                                <?php } ?>
               </div>
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="confirmPassword">Confirmer votre mot de passe</label>
                  <input type="confirmPassword" required class="form-control" name="confirmPassword" value="" id="confirmPassword" placeholder="Confirmez!" />
               </div>
            </div>
            <?php
            //profil commerçant à remplir sous conditions 
            ?>
            <fieldset>Votre commerce</fieldset>
            <hr />
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="name">Nom de votre commerce</label>
                  <input type="text" required class="form-control" name="name" value="" id="name" placeholder="Café du coin" />
               </div>
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="siret">Votre numéro de SIRET</label>
                  <input type="text" required class="form-control" name="siret" value="" id="siret" placeholder="SIRET" />
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="adresseShop">Adresse de votre commerce</label>
                  <input type="text" required class="form-control" name="adresseShop" value="" id="adresseShop" placeholder="2 Avenue de la Liberté" />
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="zipcodeShop">Code postal</label>
                  <input type="text" readonly class="form-control" name="zipcodeShop" value="" id="zipcodeShop" placeholder="60200" />
               </div>
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="cityShop">Ville</label>
                  <input type="text" readonly class="form-control" name="cityShop" value="" id="cityShop" placeholder="Compiègne" />
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="category">Catégorie</label>
                  <select name="category" required class="form-control" id="category">
                     <option value="0" selected>Faites votre choix</option>
                     <option value="1">Alimentation</option>
                     <option value="2">Café / Bars</option>
                     <option value="3">Restaurants</option>
                     <option value="4">Loisirs</option>
                     <option value="5">Services</option>
                  </select>
               </div>
            </div>
            <fieldset>Responsable de redynamisation du centre ville</fieldset>
            <hr />
            <div class="form-group row">
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="structure">Structure d'affiliation</label>
                  <input type="text" required class="form-control" aria-describedby="structureHelp" name="structure" value="" id="structure" placeholder="Mairie" />
                  <small id="structureHelp" class="form-text text-muted">Etablissement ou structure en charge de l'étude. </small>
               </div>
               <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                  <label for="service">Service concerné</label>
                  <input type="text" required class="form-control" name="structure" value="" id="structure" placeholder="Service économie" />
               </div>
            </div>
            <div class="form-group row">
               <div class="col-6 col-sm-5 col-md-5 col-lg-5 form-check">
                  <input type="checkbox" class="form-check-input" value="" id="invalidCheck" required />
                  <label for="invalidCheck" class="form-check-label">J'accepte  <a href="#">les conditions d'utilisations </a></label>
                  <div class="invalid-feedback">Vous devez accepter les conditions d'utilisations</div>
               </div>
            </div>
            <button class="btn btn-primary" type="submit">Valider</button>
         </form>
        <?php } else { ?>
                <div class="alert alert-dismissible alert-secondary" role="alert">
                    <p>Votre patient à bien été enregistrer !</p>
                </div>
      <?php } ?>
   </div>
   </section>
   <?php
   include 'includes/footer.php';
   ?>
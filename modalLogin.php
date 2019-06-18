<?php require_once  'controllers/loginCtrl.php'; ?>
<div class="modal fade" id="loginModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="loginTitle d-flex justify-content-center"><i class="fas fa-user-lock text-white mr-1"> </i> Connexion </h4>
              </div>
               <form action="modalLogin.php" method="POST">
              <div class="modal-body">
                <div>
                  <div class="form-group <?= isset($_POST['mail']) ? (isset($formErrors['mail']) ? 'has-danger' : 'has-success') : ' ' ?>">
                    <label for="mail"><i class="fas fa-at"> Login</i></label>
                    <input type="mail" name="mail" id="mail" class="form-control <?= isset($_POST['mail']) ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['mail']) ? 'value="' . $_POST['mail'] . '"' : '' ?> placeholder="mail@exemple.fr" />
                  <?php if (isset($_POST['mail']) && isset($formErrors['mail'])) { ?>
            <div class="invalid-feedback"><?= $formErrors['mail'] ?></div>
        <?php } ?>
                  </div>
                  <div class="form-group<?= isset($_POST['password']) ? (isset($formErrors['password']) ? 'has-danger' : 'has-success') : '' ?>">
                    <label for='password'><i class="fas fa-key"> Mot de passe </i></label>
                    <input type="password" name="password" id='password' class="form-control <?= isset($_POST['password']) ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['password']) ? 'value="' . $_POST['password'] . '"' : '' ?> placeholder="********"/>
                    <?php if (isset($_POST['password']) && isset($formErrors['password'])) { ?>
            <div class="invalid-feedback"><?= $formErrors['password'] ?></div>
        <?php } ?>
                  </div>
                <input type="submit" value="Connexion" class="btn btn-primary" />
              </div>
            </div>
            </form>
               <div>
                  <h3 class="loginTitle d-flex justify-content-center">Vous inscrire</h3>
                  <p>Vous êtes ? </p>
                  <a href="/inscription.php">Un particulier</a>
                  <a href="#">Une entreprise</a>
                  <a href="#">Un particulier</a>
               </div>
            <div class='modal-footer'>
               
               
              <button type='submit' class='btn btn-danger pull-left' data-dismiss='modal'>
                <span class='glyphicon glyphicon-remove'></span> Fermer
              </button>
              <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                   
                   <p>Vous n'êtes pas membre? <a href='inscription.php'>S'inscrire</a></p>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <p>Mot de passe oublié ?<a href="#">Réinitialiser votre mot de passe</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
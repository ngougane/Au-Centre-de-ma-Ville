<?php require_once  'controllers/loginCtrl.php'; ?>
<div class="modal fade" id="loginModal" role="dialog">
    <?php if (count($_POST) == 0 || !empty($formErrors)) { ?>
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="loginTitle d-flex justify-content-center"><i class="fas fa-user-lock text-white mr-1"> </i> Connexion </h4>
              </div>
               <form action="" method="POST">
              <div class="modal-body">
                <div>
                  <div class="form-group">
                    <label for="mail"><i class="fas fa-at"> Login</i></label>
                    <input type="mail" name="mail" id="mail" class="form-control <?= isset($_POST['mail']) ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['mail']) ? 'value="' . $_POST['mail'] . '"' : '' ?> placeholder="mail@exemple.fr" />
                  <?php if (isset($_POST['mail']) && isset($formErrors['mail'])) { ?>
            <div class="invalid-feedback"><?= $formErrors['mail'] ?></div>
        <?php } ?>
                  </div>
                  <div class="form-group>">
                    <label for='password'><i class="fas fa-key"> Mot de passe </i></label>
                    <input type="password" name="password" id='password' class="form-control <?= isset($_POST['password']) ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['password']) ? 'value="' . $_POST['password'] . '"' : '' ?> placeholder="********"/>
                    <?php if (isset($_POST['password']) && isset($formErrors['password'])) { ?>
            <div class="invalid-feedback"><?= $formErrors['password'] ?></div>
        <?php } ?>
                  </div>
                <input type="submit" value="Connexion" class="btn btn-primary mt-2" />
              </div>
            </div>
            </form>
               <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                      <h3 class="loginTitle">Vous inscrire</h3>
                  </div>
                     <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center mb-2">
                       <a class="btn btn-primary"  href="/register.php">Créer un compte</a>
                  </div>
               </div>
            <div class='modal-footer'>          
              <button type='submit' class='btn btn-danger pull-left' data-dismiss='modal'>
                <span class='glyphicon glyphicon-remove'></span> Fermer
              </button>
              <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                   
                   <p>Vous n'êtes pas membre? <a href='register.php'>S'inscrire</a></p>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <p>Mot de passe oublié ?<a href="#">Réinitialiser votre mot de passe</a></p>
                </div>
                   <?php 
                               } else {
                                      if (isset($formSuccess)) {  
            
         }
                               }
           ?>
              </div>
            </div>
          </div>
        </div>
</div>
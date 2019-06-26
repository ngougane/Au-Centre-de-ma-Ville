<?php require_once 'controllers/dashboardCtrl.php';?>

       
       <?php if(isset($_SESSION['mail'])){ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="index.php">Accueil</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
          <li class="nav-item <?= $_SERVER['PHP_SELF'] == '/dashboard.php' ? 'active' : '' ?>">
        <a class="nav-link" href="../controllers/logoutCtrl.php"><i class="fas fa-sign-out-alt"></i> Déconnexion </a>
      </li>
    </ul>
         <?php if (isset($_SESSION['mail'])) {
   ?>
   <p><span class="navbar-text text-white">
         <i class="fas fa-user-lock"></i>
      Bienvenue <?= isset($_SESSION) ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] : '' ?> , vous êtes connecté. 
    </span></p>
      </div>
</nav>
<?php }
        } else{ 
//        Voir pourquoi ça marche pas ?>
          
                <a href="#" class='btn btn-primary' data-toggle="modal" data-target="#loginModal"><i class="fas fa-user-lock"></i> Connexion</a>
                   <?php require 'modalLogin.php'; ?>
     <?php  }
          ?>    
<?php
session_start();
require_once 'controllers/userCtrl.php';
$titlePage = 'Dashboard';
require 'includes/header.php';
include 'includes/navbarlogout.php';

if(isset($_SESSION['mail'])){ ?>
   <section>
      <div class="row">
            <?php require 'modalLogin.php'; ?>
         </div>
   <div class="row mt-4">
      <div class="col-3">
         <!--            navbar vertical -->
         <?php include 'includes/navbar_vertical_dashboard.php'; ?>
      </div>
      <div class="offset-1 col-7 jumbotron">
         <h1>Votre espace personnel</h1>
         <?php
// Ce message ne sera visible que si ma session existe (créée avec session_start(), que ma variable de session existe
//(créée à la connexion) et donc que je suis connectée
         ?>
         <p>Bienvenue <?= isset($_SESSION['mail']) ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] : '' ?></p>
         <p>Cette section vous permettra d'accéder à votre profil, de répondre à une enquête afin de connaître vos besoins et de retrouver la liste de vos commerces de proximité.</p>
      </div>
   </div>
</section>
<?php
} else {
   ?> 
<section>
   <div class="row">
      <div class="offset-1 col-7 jumbotron">
         <p>Veuillez vous connecter</p>
      </div>
   </div>
</section>
 <?php
}
?>






<?php require 'includes/footer.php'; ?>


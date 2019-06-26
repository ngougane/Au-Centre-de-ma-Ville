<?php
require_once 'controllers/dashboardCtrl.php';
$titlePage = 'Dashboard';
require 'includes/header.php';
include 'includes/navbarlogout.php';
var_dump($_SESSION);


if (isset($_SESSION['mail'])) {
   ?>
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
            // Les messages sont personnalisés selon les rôles 
            // Role User
            if ((isset($_SESSION['role'])) && ($_SESSION['role'] == 22)) {
               ?> 
               <p>Bienvenue <?= isset($_SESSION['mail']) ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] : '' ?></p>
               <p>En tant qu'habitant de la ville de <span class="font-weight-bold"> <?= $infoUser->city ?></span> ,vous avez la possibilité de répondre à une enquête afin de connaître vos besoins et de retrouver la liste de vos commerces de proximité.</p>
               <p>Mais également d'accéder aux informations de votre profil et de les modifier. </p>
               <?php
            }
            //Role Responsable 
            if ((isset($_SESSION['role'])) && ($_SESSION['role'] == 24)) {
               ?>
               <p>Bienvenue <?= isset($_SESSION['mail']) ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] : '' ?></p>
               <p>En tant que responsable de la redynamisation de la ville de <span class="font-weight-bold"> <?= $infoService->nameCity ?></span>  rattachée à la <span class="font-weight-bold"> <?= $infoService->nameEPCI ?></span>, vous avez sur votre espace la possibilité de personnaliser les enquêtes à destination des habitants de votre ville et des commerçants.</p>
               <p>Vous pouvez également consulter les résultats des enquêtes, ainsi que l'ensemble des fiches commerces inscrites.</p>   
               <?php
            }
            //Role Commerçant 
            if ((isset($_SESSION['role'])) && ($_SESSION['role'] == 23)) {
               ?>
               <p>Bienvenue <?= isset($_SESSION['mail']) ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] : '' ?></p>
               <p>En tant que responsable d'un commerce dans la ville de <span class="font-weight-bold"> <?= $infoUser->city ?></span>, vous avez la possibilité de répondre à une enquête afin de connaître vos besoins. </p>
               <p>Les informations collectées serviront afin de redynamiser l'activité commerciale de votre ville d'implantation.</p> 
               <p>Sur votre espace personnel, vous pouvez à tout moment modifier vos informations personnels, accèder à la fiche de votre commerce et en modifier les informations.</p>
               <p>Vous pouvez également suivre les statistiques de fréquentation de votre commerce ou valider la visite d'un client. </p>
               <p><?= $infoStore->openingTime ?></p>
               <?php
            }
            ?>    
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
 require 'includes/footer.php'; ?>

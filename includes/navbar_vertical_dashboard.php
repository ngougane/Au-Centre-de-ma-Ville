
<ul class="nav flex-column nav-pills flex-sm-row">
   <li class="nav-item">
    <a class="nav-link flex-sm-fill text-sm-center" href="dashboardProfil.php"><img class="img-fluid" src="https://img.icons8.com/bubbles/50/000000/gender-neutral-user.png" /><span> Profil </span></a>
  </li>
  <?php 
  //Liens du menu latéral des habitants 
  if((isset($_SESSION['role'])) && ($_SESSION['role'] == 22) ){
     ?> 
    <li class="nav-item">
    <a class="nav-link flex-sm-fill text-sm-center" href="#"><img class="img-fluid" src="https://img.icons8.com/bubbles/50/000000/test-passed.png" /><span> Enquête </span></a>
  </li>
    <li class="nav-item">
    <a class="nav-link flex-sm-fill text-sm-center" href="#"><img class="img-fluid" src="https://img.icons8.com/bubbles/50/000000/small-business.png" /><span> Mes commerces</span></a>
  </li>
    <li class="nav-item">
    <a class="nav-link flex-sm-fill text-sm-center" href="#"><img class="img-fluid" src="https://img.icons8.com/bubbles/50/000000/employee-card.png" /><span> Programme fidélité</span></a>
  </li>
 <?php
  }
  ?>
    <?php 
      //Liens du menu latéral des commerçants  
  if((isset($_SESSION['role'])) && ($_SESSION['role'] == 23) ){
          ?> 
    <li class="nav-item">
    <a class="nav-link flex-sm-fill text-sm-center" href="#"><img class="img-fluid" src="https://img.icons8.com/bubbles/50/000000/test-passed.png" /><span> Enquête </span></a>
  </li>
    <li class="nav-item">
    <a class="nav-link flex-sm-fill text-sm-center" href="clickAndCollect.php"><img class="img-fluid" src="https://img.icons8.com/bubbles/50/000000/small-business.png" /><span> Click & collect </span></a>
  </li>
    <li class="nav-item">
    <a class="nav-link flex-sm-fill text-sm-center" href="#"><img class="img-fluid" src="https://img.icons8.com/bubbles/50/000000/employee-card.png" /><span> Valider une visite </span></a>
  </li>
 <?php
  }
  ?>
    <?php 
      //Liens du menu latéral des responsables 
  if((isset($_SESSION['role'])) && ($_SESSION['role'] == 24) ){
          ?> 
    <li class="nav-item">
    <a class="nav-link flex-sm-fill text-sm-center" href="#"><img class="img-fluid" src="https://img.icons8.com/bubbles/50/000000/test-passed.png" /><span> Résultats des enquêtes </span></a>
  </li>
    <li class="nav-item">
    <a class="nav-link flex-sm-fill text-sm-center" href="#"><img class="img-fluid" src="https://img.icons8.com/bubbles/50/000000/small-business.png" /><span>Les commerces</span></a>
  </li>
 <?php
     
  }
  ?>
</ul>


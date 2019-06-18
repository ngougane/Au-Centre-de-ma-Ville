<?php
$titlePage = "Liste des commerces - Au centre de ma ville";
include 'includes/header.php';
?>
<div class="row">
   <div class="col-12 col-sm-12 col-md-12 col-lg-12">
      <h1 class="border-bottom mt-3">Liste des commerces de votre centre ville</h1>
   </div>
</div>
<div class="row">
   <div class="col-12 col-sm-12 col-md-12 col-lg-12">
      <div class="mapNoyon map-responsive">
         <iframe src="https://www.google.com/maps/d/embed?mid=1cPqiBZ8EQGqpRW7l4TEoqXKHWZK7TXCv" style="border: 0" allowfullscreen=""></iframe>
      </div>
   </div>
</div>
<section>
   <div class="row">
      <div class="col-4">
         <div class="card bg-light mb-3">
            <div class="card-header">
               <h3 class="card-title text-center">Boulangerie - Patisserie Vincent Porée</h3>
            </div>
            <img  class="card-img-top" src="assets/img/boulangerie_poree1.JPG" alt="">
            <div class="card-body">
               <?php //trouver les picto pour les catégories ?>
               <h4 class="card-subtitle text-muted">Catégorie : Boulangerie / patisserie</h4>
               <p class="card-text">Description - Boulangerie artisanale Maison fondée depuis 1863. </p>
               <ul class="list-group list-group-flush">
                  <li class="list-group-item"><span class="text-muted">Adresse : </span>73 Rue de Paris, 60400 Noyon </li>
                  <li class="list-group-item"><span class="text-muted">Horaires : </span> Du lundi au vendredi - 9h / 18h </li>
                  <li class="list-group-item"> <span class="text-muted">Téléphone : </span> 03 44 85 25 81 </li>
               </ul>
               <div class="accordion" id="accordionShop">
                  <div class="card-text" id="headingServices">
                     <h5>
                        <i class="fas fa-concierge-bell">
                           <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseServices" aria-expanded="true" aria-controls="collapseServices">
                              Services
                           </button>
                        </i>
                     </h5>
                  </div>
                  <div id="collapseServices" class="collapse show" aria-labelledby="headingServices" data-parent="#accordionShop">
                     <div class="card-text">
                        Liste des services à définir
                     </div>
                  </div>
                  <div class="card-text" id="headingClickAndCollect">
                     <h5>
                        <i class="fas fa-shopping-basket">
                           <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseClickAndCollect" aria-expanded="true" aria-controls="collapseClickAndCollect">
                              Click and Collect
                           </button>
                        </i>
                     </h5>
                  </div>
                  <div id="collapseClickAndCollect" class="collapse show" aria-labelledby="headingServices" data-parent="#accordionShop">
                     <div class="card-text">
                        Liste des services à définir
                     </div>
                  </div>

               </div>
            </div>
            <div class="card-footer"> 
               <a href="#" class="btn btn-primary"> Ajouter à mon compte</a>
               <a href="#" class="btn btn-primary">Voir le détail</a>
            </div>
         </div>
      </div>
      <div class="col-4">
         <div class="card bg-light mb-3">
            <div class="card-header">
               <h3 class="card-title text-center">Boulangerie - Patisserie Vincent Porée</h3>
            </div>
            <img  class="card-img-top" src="assets/img/boulangerie_poree1.JPG" alt="">
            <div class="card-body">
               <?php //trouver les picto pour les catégories ?>
               <h4 class="card-subtitle text-muted">Catégorie : Boulangerie / patisserie</h4>
               <p class="card-text">Description - Boulangerie artisanale Maison fondée depuis 1863. </p>
               <ul class="list-group list-group-flush">
                  <li class="list-group-item"><span class="text-muted">Adresse : </span>73 Rue de Paris, 60400 Noyon </li>
                  <li class="list-group-item"><span class="text-muted">Horaires : </span> Du lundi au vendredi - 9h / 18h </li>
                  <li class="list-group-item"> <span class="text-muted">Téléphone : </span> 03 44 85 25 81 </li>
               </ul>
               <div class="accordion" id="accordionShop">
                  <div class="card-text" id="headingServices">
                     <h5>
                        <i class="fas fa-concierge-bell">
                           <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseServices" aria-expanded="true" aria-controls="collapseServices">
                              Services
                           </button>
                        </i>
                     </h5>
                  </div>
                  <div id="collapseServices" class="collapse show" aria-labelledby="headingServices" data-parent="#accordionShop">
                     <div class="card-text">
                        Liste des services à définir
                     </div>
                  </div>
                  <div class="card-text" id="headingClickAndCollect">
                     <h5>
                        <i class="fas fa-shopping-basket">
                           <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseClickAndCollect" aria-expanded="true" aria-controls="collapseClickAndCollect">
                              Click and Collect
                           </button>
                        </i>
                     </h5>
                  </div>
                  <div id="collapseClickAndCollect" class="collapse show" aria-labelledby="headingServices" data-parent="#accordionShop">
                     <div class="card-text">
                        Liste des services à définir
                     </div>
                  </div>

               </div>
            </div>
            <div class="card-footer"> 
               <a href="#" class="btn btn-primary"> Ajouter à mon compte</a>
               <a href="#" class="btn btn-primary">Voir le détail</a>
            </div>
         </div>
      </div>
   </div>

</section>
<?php include 'includes/footer.php'; ?>

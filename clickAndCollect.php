<?php
require_once 'controllers/clickAndCollectCtrl.php';
$titlePage = 'Click And Collect';
require 'includes/header.php';
require 'includes/navbarlogout.php';
/*
 * Vue qui gére les produits des commerces pour le click en collect
 */
?>
<section>
   <div class="row mt-4">
      <div class="col-12">
         <!--            navbar vertical -->
         <?php
         include 'includes/navbar_vertical_dashboard.php';
         ?>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="row mt-2">
               <div class="col-12 mb-1 table-responsive-sm">
                  <h2>Liste de vos produits en vente - Click And Collect</h2>
                  <table class="table">
                     <thead class="thead-light">
                        <tr>
                           <th class="col-2">Photo</th>
                           <th>Nom</th>
                           <th>Description</th>
                           <th>Prix</th>
                           <th>Catégorie</th>
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($listProducts as $productStore) { ?>
                           <tr>
                              <td><img src="<?= 'uploads/' . $productStore->photo ?>"/></td>
                              <td><?= $productStore->name ?></td>
                              <td><?= $productStore->description ?></td>
                              <td><?= $productStore->price ?></td>
                              <td><?= $productStore->category ?></td>
                              <td><a href="clickAndCollect.php?edit=<?= $productStore->id ?>" class="btn btn-info"> Editer </a></td>
                              <td><a href="clickAndCollect.php?delete=<?= $productStore->id ?>" class="btn btn-danger"> Supprimer </a></td>
                           </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                  <?php
                  if (isset($_GET['delete'])) {
                     ?>
                     <div class="alert alert-danger" role="alert"><?= $deleteSuccess ?> </div>
                     <?php
                  } 
                  ?>
               </div>
               <div class="col-12 mb-1">
                  <?php if (count($_POST) == 0 || count($formErrors) > 0) {
                     ?>
                     <form action= "" name="productStore" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                           <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                              <label for="category">Catégorie</label>
                              <input type="text"   class="form-control  <?= isset($formErrors['category']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="category" value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['category']) : "" ?>" id="category" placeholder="Baguette" />
                              <?php
                              if (isset($formErrors['category'])) {
                                 ?>
                                 <div class="invalid-feedback alert alert-danger" role="alert">
                                    <p><?= $formErrors['category'] ?></p>
                                 </div>
                              <?php } ?>
                           </div>
                           <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                              <label for="name">Nom du produit</label>
                              <input type="text"   class="form-control  <?= isset($formErrors['name']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="name" value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['name']) : "" ?>" id="name" placeholder="Baguette céréale bio" />
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
                           <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-2">
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

                        </div>
                        <div class="form-group row">
                           <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                              <label for="description">Description</label>
                              <input type="text"   class="form-control  <?= isset($formErrors['description']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="description" value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['description']) : "" ?>" id="description" placeholder="Fabrication artisanale" />
                              <?php
                              if (isset($formErrors['description'])) {
                                 ?>
                                 <div class="invalid-feedback alert alert-danger" role="alert">
                                    <p><?= $formErrors['description'] ?></p>
                                 </div>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                              <label for="price">Prix</label>
                              <input type="text"   class="form-control  <?= isset($formErrors['price']) ? 'is-invalid' : (count($_POST) > 0 ? 'is-valid' : '') ?>" name="price" value="<?= count($formErrors) > 0 ? htmlspecialchars($_POST['price']) : "" ?>" id="price" placeholder="1.20€" />
                              <?php
                              if (isset($formErrors['price'])) {
                                 ?>
                                 <div class="invalid-feedback alert alert-danger" role="alert">
                                    <p><?= $formErrors['price'] ?></p>
                                 </div>
                              <?php } ?>
                           </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Ajouter</button>
                     </form>
                     <?php
                  } else {
                     ?> Ajouter un produit <?php
                  }  //mettre le message de sucess
                  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php require 'includes/footer.php'; ?>
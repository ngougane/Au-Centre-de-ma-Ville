<?php require 'includes/headerHome.php'; ?>
<body>
   <div class="container-fluid">
      <header>
         <div class="header">
            <div class="row">
               <div class="headerlogo col-2 col-sm-2 col-md-3 col-lg-3 col-xl-4">
                  <img class="img-fluid" src="assets/img/logo.png" alt="logo" title="logo" />
               </div>
            </div>
            <div class="mainText">
               <div class="row">
                  <div class="headerTitle col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                     <h1> Ma ville c'est <span class="typed-text"></span><span class="cursor">&nbsp;</span></h1>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-end">
                  <p>
                     <a href="#" class='btn btn-primary' data-toggle="modal" data-target="#loginModal"><span><i class="fas fa-user"></i> </span>Se connecter</a>
                  </p>
               </div>
            </div>
         </div>
      </header>
      <section>
         <div class="row">
            <?php require 'modalLogin.php'; ?>
         </div>
         <div class="row">
            <div class="col-12">
               <h2 class="titleStorytelling mt-4">Notre histoire en image</h2>
            </div>
         </div>
         <div class="storytelling row">
            <div class="col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10 mx-auto mb-3 mt-3">
               <?php // NOTE: StoryTelling ?>
               <div class="embed-responsive embed-responsive-21by9">
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/Xjo9GCmDD-E" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
               </div>
            </div>
         </div>
      </section>
      <section>
         <div class="step row d-flex justify-content-around mt-2">
            <div class="card firstStep col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mt-2 mb-2">
               <?php // NOTE: section etape story ?>
               <div class="row">
                  <div class="card-header titleStep col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center rounded-left bg-danger">
                     <h2 class="text-white text-center">Etape 1</h2>
                  </div>
                  <div class="card-body mt-2">
                     <div class="row">
                        <div class="imageStep col-2 col-sm-2 col-md-4 col-lg-4 col-xl-4 align-self-center">
                           <img class="img-fluid rounded float-left" src="assets/img/consulation.png" alt="consultation" title="Consulation" />
                        </div>
                        <div class="textStep col-10 col-sm-10 col-md-8 col-lg-8 col-xl-8 align-self-center">
                           <h3 class="card-title">Consultation publique</h3>
                        </div>
                     </div>
                     <div class="row card-text mt-2">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 md-auto">
                           <p >Habitants, commerçants, élus ou membre de la CCI : cette consultation est la vôtre. En répondant aux enquêtes vous nous permettrez de recenser les attentes et difficultés de chacun.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card secondStep col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mt-2 mb-2">
               <?php // NOTE: section etape story ?>
               <div class="row">
                  <div class="card-header titleStep col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center rounded-left bg-danger">
                     <h2 class="text-white text-center">Etape 2</h2>
                  </div>
                  <div class="card-body mt-2">
                     <div class="row">
                        <div class="imageStep col-2 col-sm-2 col-md-4 col-lg-4 col-xl-4 align-self-center">
                           <img class="img-fluid rounded float-left" src="assets/img/diagnostic.png" alt="diagnostic" title="diagnostic" />
                        </div>
                        <div class="textStep col-10 col-sm-10 col-md-8 col-lg-8 col-xl-8 align-self-center">
                           <h3>Diagnostic</h3>
                        </div>
                     </div>
                     <div class="row card-text mt-2">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 md-auto">
                           <p>Le résultat des enquêtes permettra de lever avec les différents acteurs les freins et problématiques. L'objectif est de mettre en place les solutions de redynamisation de votre centre ville. </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card thirdStep col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mt-2 mb-2">
               <?php // NOTE: section etape story ?>
               <div class="row">
                  <div class="card-header titleStep col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center rounded-left bg-danger">
                     <h2 class="text-white text-center">Etape 3</h2>
                  </div>
                  <div class="card-body mt-2">
                     <div class="row">
                        <div class="imageStep col-2 col-sm-2 col-md-4 col-lg-4 col-xl-4 align-self-center">
                           <img class="img-fluid rounded float-left" src="assets/img/poignet-de-main.png" alt="accord" title="accord" />
                        </div>
                        <div class="textStep col-10 col-sm-10 col-md-8 col-lg-8 col-xl-8 align-self-center">
                           <h3>Les solutions</h3>
                        </div>
                     </div>
                     <div class="row card-text mt-2">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 md-auto">
                           <p>Ensemble élaborons une ville qui vous ressemble et qui vous rassemble. Avec une offre de services et des avantages qui répondent à vos besoins.</p>
                           <a  class="btn btn-primary"  href="inscription.php">S'inscrire</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="advantageTitle row text-white mt-2 d-flex justify-content-around">
            <div class="col-10 col-sm-10 col-md-10 col-lg-10">
               <h3 class="text-center ">Vos avantages</h3>
               <p class="text-center">Notre programme inclut le développement des services suivants ou d'autres services correspondant à vos besoins.</p>
            </div>
         </div>
         <div class="row mt-3 d-flex justify-content-around">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
               <div class="card border-0">
                  <div class="card-header bg-danger">
                     <div class="row">
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                           <img  class="img-fluid rounded-left" src="assets/img/carte.png" height="128" width="128" alt="carte fidélité"/>
                        </div>
                        <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 align-self-center">
                           <h4 class="card-title text-white">Votre compte fidélité</h4>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <p>Comme par un exemple : un cumul de points crédités sur votre compte fidélité et qui vous permettra de régler votre parking, le click and collect pour réserver en ligne et retirer en magasin ou encore un service de conciergerie pour des retraits en dehors des horaires d'ouvertures. </p>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
               <div class="card border-0">
                  <div class="card-header bg-danger">
                     <div class="row">
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                           <img class="img-fluid rounded-left" src="assets/img/clickAndCollect.png" alt="clickAndCollect"/>
                        </div>
                        <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 align-self-center">
                           <h4 class="card-title text-white">Le click and collect</h4>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <p>Comme par un exemple : un cumul de points crédités sur votre compte fidélité et qui vous permettra de régler votre parking, le click and collect pour réserver en ligne et retirer en magasin ou encore un service de conciergerie pour des retraits en dehors des horaires d'ouvertures. </p>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
               <div class="card border-0">
                  <div class="card-header bg-danger">
                     <div class="row">
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                           <img class="img-fluid rounded-circle float-left" src="assets/img/conciergerie.png"  alt="conciergerie"/>
                        </div>
                        <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 align-self-center">
                           <h4 class="card-title text-white">Le service conciergerie</h4>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <p>Comme par un exemple : un cumul de points crédités sur votre compte fidélité et qui vous permettra de régler votre parking, le click and collect pour réserver en ligne et retirer en magasin ou encore un service de conciergerie pour des retraits en dehors des horaires d'ouvertures. </p>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section>
         <div class="container">
            <div class="row">
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <h3 class="partnersTitle text-center">Les villes partenaires</h3>
               </div>
               <div class="container carouselPartners">
                  <div id="carousel-example" class="carousel slide" data-ride="carousel">
                     <div class="carousel-inner row w-50 mx-auto" role="listbox">
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                           <img src="assets/img/compiegne.png" class="img-fluid mx-auto d-block" alt="img1">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                           <img src="assets/img/choisyAuBac.png" class="img-fluid mx-auto d-block" alt="img2">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                           <img src="assets/img/pontoise.png" class="img-fluid mx-auto d-block" alt="img3">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                           <img src="assets/img/gaspe.png" class="img-fluid mx-auto d-block" alt="img4">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                           <img src="assets/img/enze.jpeg" class="img-fluid mx-auto d-block" alt="img5">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                           <img src="assets/img/saintouen.png" class="img-fluid mx-auto d-block" alt="img6">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                           <img src="assets/img/pantin.png" class="img-fluid mx-auto d-block" alt="img7">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                           <img src="assets/img/lens.png" class="img-fluid mx-auto d-block" alt="img8">
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="titleComments col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center border-bottom border-light">
               <h3>Ils ont vécu l'expérience et vous en parle </h3>
            </div>
         </div>
         <div class="row">
            <div class="comments col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
               <?php // NOTE: commentaires ?>
               <div class="row media">
                  <div class="col-2 col-sm-2 col-md-3 col-lg-3 col-xl-3">
                     <img class="img-fluid" src="assets/img/profiluserman.png" alt="avatar user">
                  </div>
                  <div class="media-body col-10 col-sm-10 col-md-9 col-lg-9 col-xl-9">
                     <h4>Une expérience à tenter </h4>
                     <h5 class="blockquote-footer">Mathieu</h5>
                     <p><span><i class="fas fa-quote-left"></i></span> J'ai trouvé une possibilité de m'exprimer et de donner mon avis. <span><i class="fas fa-quote-right"></i></span></p>
                  </div>
               </div>
            </div>
            <div class="comments col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
               <?php // NOTE: commentaires ?>
               <div class=" row media">
                  <div class="col-2 col-sm-2 col-md-3 col-lg-3 col-xl-3">
                     <img class="img-fluid" src="assets/img/profiluser.png" alt="avatar user">
                  </div>
                  <div class="media-body col-10 col-sm-10 col-md-9 col-lg-9 col-xl-9">
                     <h4 class="mt-0">Une expérience à tenter </h4>
                     <h5 class="blockquote-footer">Noémie</h5>
                     <p><span><i class="fas fa-quote-left"></i></span> J'ai trouvé une possibilité de m'exprimer et de donner mon avis. <span><i class="fas fa-quote-right"></i></span></p>
                  </div>
               </div>
            </div>
            <div class="comments col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
               <?php // NOTE: commentaires ?>
               <div class="row media">
                  <div class="col-2 col-sm-2 col-md-3 col-lg-3 col-xl-3">
                     <img class="img-fluid" src="assets/img/profiluserman.png" alt="avatar user">
                  </div>
                  <div class="media-body col-10 col-sm-10 col-md-9 col-lg-9 col-xl-9">
                     <h4 class="mt-0">Une expérience à tenter </h4>
                     <h5 class="blockquote-footer">Pascal</h5>
                     <p><span><i class="fas fa-quote-left"></i></span> J'ai trouvé une possibilité de m'exprimer et de donner mon avis. <span><i class="fas fa-quote-right"></i></span></p>
                  </div>
               </div>
            </div>
            <div class="comments col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
               <?php // NOTE: commentaires ?>
               <div class="row media">
                  <div class="col-2 col-sm-2 col-md-3 col-lg-3 col-xl-3">
                     <img class="img-fluid" src="assets/img/profiluser.png" alt="avatar user">
                  </div>
                  <div class="media-body col-10 col-sm-10 col-md-9 col-lg-9 col-xl-9">
                     <h4 class="mt-0">Une expérience à tenter </h4>
                     <h5 class="blockquote-footer">Noémie</h5>
                     <p><span><i class="fas fa-quote-left"></i></span> J'ai trouvé une possibilité de m'exprimer et de donner mon avis. <span><i class="fas fa-quote-right"></i></span></p>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php require 'includes/footer.php'; ?>

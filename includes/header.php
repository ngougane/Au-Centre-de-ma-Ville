
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css"/><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script> 
  <link href="https://fonts.googleapis.com/css?family=Carter+One|Fredericka+the+Great" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Wendy+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
  <?php
//Si le titre est indiqué, on l'affiche entre les balises <title>
echo (!empty($titlePage))?'<title>'.$titlePage.'</title>':'<title> Au centre de ma ville </title>';
?>
</head>
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
         </div>
      </header>


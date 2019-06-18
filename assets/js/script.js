/**
 * Fonction d'animation du texte du header - texte tapé
 * @type Element
 */
//Déclaration de toutes les constantes
//Par la méthode querySelector on détermine les marqueurs du document
const typedTextSpan = document.querySelector(".typed-text");
const cursorSpan = document.querySelector(".cursor");
//On définit un tableau avec des valeurs qui seront injecté dans le tableau tapé
const textArray = ["Milouda", "Antoine", "Pierre", "Anaïs", "Julien", "Brigitte", "Hassen", "Tatjana", "Damien", "Sidi", "Virginie", "Clément", "Francky", "Moussa", "Théo"];
const typingSpeed = 200;//vitesse de frappe
const erasingSpeed = 100;//vitesse pour effecar le texte
const newTextDelay = 2000; // Délai de la transition entre le nouveau et l'ancien texte tapé
let textArrayIndex = 0; // textArray index
let charIndex = 0; // character index

function type() {

   if (charIndex < textArray[textArrayIndex].length) {
      if (!cursorSpan.classList.contains("typing"))
         cursorSpan.classList.add("typing");
      typedTextSpan.textContent += textArray[textArrayIndex].charAt(charIndex);
      charIndex++;
      setTimeout(type, typingSpeed);
   } else {
      cursorSpan.classList.remove("typing");
      setTimeout(erase, newTextDelay);
   }
}

function erase() {
   if (charIndex > 0) {
      if (!cursorSpan.classList.contains("typing"))
         cursorSpan.classList.add("typing");
      typedTextSpan.textContent = textArray[textArrayIndex].substring(0, charIndex - 1);
      charIndex--;
      setTimeout(erase, erasingSpeed);
   } else {
      cursorSpan.classList.remove("typing");
      textArrayIndex++;
      if (textArrayIndex >= textArray.length)
         textArrayIndex = 0;
      setTimeout(type, typingSpeed + 1100);
   }
}

document.addEventListener("DOMContentLoaded", function () { // On DOM Load initiate the effect
   setTimeout(type, newTextDelay + 250);
});

// Carrousel

$('#carouselExample').on('slide.bs.carousel', function (e) {

   /*
    
    CC 2.0 License Iatek LLC 2018
    Attribution required
    
    */

   var $e = $(e.relatedTarget);
   var idx = $e.index();
   var itemsPerSlide = 5;
   var totalItems = $('.carousel-item').length;

   if (idx >= totalItems - (itemsPerSlide - 1)) {
      var it = itemsPerSlide - (totalItems - idx);
      for (var i = 0; i < it; i++) {
         // append slides to end
         if (e.direction == "left") {
            $('.carousel-item').eq(i).appendTo('.carousel-inner');
         } else {
            $('.carousel-item').eq(0).appendTo('.carousel-inner');
         }
      }
   }
});


//Fonction qui nous permet de sélectionner le profil de l'utilisateur lors de l'inscription
//On peut ainsi faire apparaitre ou masquer des parties du questionnaire selon l'id 
//retourner par le choix des boutons radios : vous êtes un habitant , un commerçant ou un responsable
//Par défaut le bouton radio habitant est checked 
//et les div contenant les champs des formulaires des commerçants et des responsables
//Les champs de ces div là ne contiennent pas d'attribut required ce sera fait de manière dynamique. 

// Faire une fonction des instructions à faire à chaque click - et re lancer au chargement avec une condition au load 
$(function () {
   $('#22').attr('checked', 'checked');
   $('#tradeInfo').hide();
   $('#responsableInfo').hide();
});

$('#22').click(function () {
   $('#22').attr('checked', 'checked');
   $('#23').removeAttr('checked');
   $('#24').removeAttr('checked', 'checked');
   $('#tradeInfo').hide();
   $('#sirenSearch').removeAttr('required');
   $('#file').removeAttr('required');
   $('#responsableInfo').hide();
   $('#jobTitle').removeAttr('required');
   $('#phoneNumberService').removeAttr('required');
   $('#service').removeAttr('required');
   $('#sirenCity').removeAttr('required');
});

$('#23').click(function () {
   $('#23').attr('checked', 'checked');
   $('#22').removeAttr('checked');
   $('#24').removeAttr('checked', 'checked');
   $('#tradeInfo').show();
   $('#sirenSearch').attr('required', 'required');
   $('#file').attr('required', 'required');
   $('#responsableInfo').hide();
   $('#jobTitle').removeAttr('required');
   $('#phoneNumberService').removeAttr('required');
   $('#service').removeAttr('required');
   $('#sirenCity').removeAttr('required');


});

$('#24').click(function () {
   $('#24').attr('checked', 'checked');
   $('#22').removeAttr('checked');
   $('#23').removeAttr('checked', 'checked');
   $('#tradeInfo').hide();
   $('#sirenSearch').removeAttr('required');
   $('#file').removeAttr('required');
   $('#responsableInfo').show();
   $('#jobTitle').attr('required', 'required');
   $('#phoneNumberService').attr('required', 'required');
   $('#service').attr('required', 'required');
   $('#sirenCity').attr('required', 'required');
});


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///Ajax pour l'autocomplétion - remplit le champs ville à la saisie du code postal ///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(function () {

   //Etape 1 : Je crée mon évènements (et je le teste)
   $('#search').keyup(function () {
      /**
       * Etape 2 : j'appelle la fonction ajax 
       * J'utilise :
       *      * $.post si je veux envoyer de données en post, cela enverra une variable $_POST
       *      * $.get si je veux en envoyer en get, cela enverra une variable $_GET
       * Je lie mon controller EN PARTANT DU SCRIPT.JS
       * J'envoie ce que je dois envoyer. Ici, je veux envoyer ce que j'ai tapé dans mon champs
       * de recherche ($('#search').val()) et je veux l'envoyer dans une variable qui s'appellera $_POST['search']
       */
      if ($("#search").val().length >= 3)
         $.post('../../controllers/usersRegisterCtrl.php', {
            search: $('#search').val()
                    /**
                     * function (data) est la fonction qui s'éxécutera une fois que le contrôleur aura fini
                     * data est le retour du contrôleur (ce qu'on a mis dans echo json_encode())
                     */
         }, function (data) {
            console.log(data);
            /*
             * Etape 4 : L'affichage
             * Je récupère ce qui a été retourné du PHP grâce au echo json_encode, on le convertit en tableau d'objet js et on le stocke
             * dans la variable results.
             */
            $('.alert').remove();
            $('#city').empty();
            var results = $.parseJSON(data);

            //4.1 : Je vide le tableau pour préparer l'affichage (enlever les résultats déjà présents

            //4.2 : Je vérifie que le tableau de résultats n'est pas vide
            if (results.length > 0) {
               //4.3 : Je parcours le tableau (similaire à foreach($results as $key=>$patient). patient est un objet contenu dans le tableau
               $.each(results, function (key, city) {
                  /*
                   * 4.4 : Je crée une variable qui contiendra la concaténation des balises servant à l'affichage (ici des cellules de tableau)
                   * On y injecte les information du patient
                   */
                  var display = '<option value="' + city.id + '">' + city.city + ' ' + '</option >';
                  //J'ajoute la ligne que je viens de créer au tableau, cette opération se répètera pour chaque patient dans le tableau results
                  $('#city').append(display);
               });
            } else {
               //4.5 : Si mon tableau est vide, je créer une alerte qui me dira que je n'ai pas de résultat et je l'insère après le tableau
               var alert = '<div class="alert alert-danger" role="alert">Pas de résultats</div>';
               $(alert).insertAfter('#city');
            }
         }
         );
   });

});

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///Ajax pour l'autocomplétion - Saisie du SIREN et retour des infos du commerce////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(function () {

   //Etape 1 : Je crée mon évènements (et  je le teste)
   $('#sirenSearch').keyup(function () {
      /**
       * Etape 2 : j'appelle la fonction ajax 
       * J'utilise :
       *      * $.post si je veux envoyer de données en post, cela enverra une variable $_POST
       *      * $.get si je veux en envoyer en get, cela enverra une variable $_GET
       * Je lie mon controller EN PARTANT DU SCRIPT.JS
       * J'envoie ce que je dois envoyer. Ici, je veux envoyer ce que j'ai tapé dans mon champs
       * de recherche ($('#search').val()) et je veux l'envoyer dans une variable qui s'appellera $_POST['search']
       */
      if ($("#sirenSearch").val().length >= 2)
         $.post('../../controllers/usersRegisterCtrl.php', {
            sirenSearch: $('#sirenSearch').val()
                    /**
                     * function (data) est la fonction qui s'éxécutera une fois que le contrôleur aura fini
                     * data est le retour du contrôleur (ce qu'on a mis dans echo json_encode())
                     */
         }, function (dataSiren) {
            console.log(dataSiren);
            /*
             * Etape 4 : L'affichage
             * Je récupère ce qui a été retourné du PHP grâce au echo json_encode, on le convertit en tableau d'objet js et on le stocke
             * dans la variable results.
             */
            $('.alert').remove();
            $('#activity').empty();
            $('#name').empty();

            var resultSiren = $.parseJSON(dataSiren);

            //4.1 : Je vide le tableau pour préparer l'affichage (enlever les résultats déjà présents

            //4.2 : Je vérifie que le tableau de résultats n'est pas vide
            if (resultSiren.length > 0) {
               //4.3 : Je parcours le tableau (similaire à foreach($results as $key=>$patient). patient est un objet contenu dans le tableau
               $.each(resultSiren, function (key, siren) {
                  /*
                   * 4.4 : Je crée une variable qui contiendra la concaténation des balises servant à l'affichage (ici des cellules de tableau)
                   * On y injecte les information du patient
                   */
                  var display = '<option value="' + siren.id + '"  ' + 'readonly >' + siren.activity + ' ' + '</option >'
                  //J'ajoute la ligne que je viens de créer au tableau, cette opération se répètera pour chaque patient dans le tableau results
                  $('#activity').append(display);
                  var displayName = '<option value="' + siren.id + '"  ' + 'readonly >' + siren.raisonSociale + ' ' + '</option >'
                  //J'ajoute la ligne que je viens de créer au tableau, cette opération se répètera pour chaque patient dans le tableau results
                  $('#name').append(displayName);

               });
            } else {
               //4.5 : Si mon tableau est vide, je créer une alerte qui me dira que je n'ai pas de résultat et je l'insère après le tableau
               var alert = '<div class="alert alert-danger" role="alert" readonly>Pas de résultats</div>';
               $(alert).insertAfter('#activity');
               var alert = '<div class="alert alert-danger" role="alert" readonly>Pas de résultats</div>';
               $(alert).insertAfter('#name');
            }
         }
         );
   });

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///Ajax pour l'autocomplétion - Saisie du SIREN de la commune et retourne  le siren EPCI et le nom de la commune /// 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(function () {

   //Etape 1 : Je crée mon évènements (et je le teste)
   $('#sirenCitySearch').keyup(function () {
      /**
       * Etape 2 : j'appelle la fonction ajax 
       * J'utilise :
       *      * $.post si je veux envoyer de données en post, cela enverra une variable $_POST
       *      * $.get si je veux en envoyer en get, cela enverra une variable $_GET
       * Je lie mon controller EN PARTANT DU SCRIPT.JS
       * J'envoie ce que je dois envoyer. Ici, je veux envoyer ce que j'ai tapé dans mon champs
       * de recherche ($('#search').val()) et je veux l'envoyer dans une variable qui s'appellera $_POST['search']
       */
      if ($("#sirenCitySearch").val().length >= 3)
         $.post('../../controllers/usersRegisterCtrl.php', {
            sirenCitySearch: $('#sirenCitySearch').val()
                    /**
                     * function (data) est la fonction qui s'éxécutera une fois que le contrôleur aura fini
                     * data est le retour du contrôleur (ce qu'on a mis dans echo json_encode())
                     */
         }, function (dataSirenCity) {
            console.log(dataSirenCity);
            /*
             * Etape 4 : L'affichage
             * Je récupère ce qui a été retourné du PHP grâce au echo json_encode, on le convertit en tableau d'objet js et on le stocke
             * dans la variable results.
             */
            $('.alert').remove();
            $('#sirenEpci').empty();
            $('#nameEpci').empty();

            var resultSirenCity = $.parseJSON(dataSirenCity);

            //4.1 : Je vide le tableau pour préparer l'affichage (enlever les résultats déjà présents

            //4.2 : Je vérifie que le tableau de résultats n'est pas vide
            if (resultSirenCity.length > 0) {
               //4.3 : Je parcours le tableau (similaire à foreach($results as $key=>$patient). patient est un objet contenu dans le tableau
               $.each(resultSirenCity, function (key, sirenCity) {
                  /*
                   * 4.4 : Je crée une variable qui contiendra la concaténation des balises servant à l'affichage (ici des cellules de tableau)
                   * On y injecte les information du patient
                   */
                  var display = '<option value="' + sirenCity.id + '"  ' + 'readonly >' + sirenCity.id + ' ' + '</option >'
                  //J'ajoute la ligne que je viens de créer au tableau, cette opération se répètera pour chaque patient dans le tableau results
                  $('#sirenEpci').append(display);
                  var displayName = '<option value="' + sirenCity.id + '"  ' + 'readonly >' + sirenCity.id + ' ' + '</option >'
                  //J'ajoute la ligne que je viens de créer au tableau, cette opération se répètera pour chaque patient dans le tableau results
                  $('#nameEpci').append(displayName);

               });
            } else {
               //4.5 : Si mon tableau est vide, je créer une alerte qui me dira que je n'ai pas de résultat et je l'insère après le tableau
               var alert = '<div class="alert alert-danger" role="alert" readonly>Pas de résultats</div>';
               $(alert).insertAfter('#sirenEpci');
               var alert = '<div class="alert alert-danger" role="alert" readonly>Pas de résultats</div>';
               $(alert).insertAfter('#nameEpci');
            }
         }
         );
   });

});

/**
 * Fenêtre modale du dashboard user - confirmation de suppression 
 */

$(function () {
   //Fonction qui permet de déclencher les actions que l'on souhaite à l'affichage de la modale
   $('#deleteModal').on('show.bs.modal', function (event) {
      //On stocke dans une variable le bouton qui appelle la modale.
      var button = $(event.relatedTarget);
      //On récupère les attributs data- du bouton qui a appelé la modale. On récupère donc l'id du patient, son nom de famille et son prénom
      var userId = button.data('id');
      var userLastname = button.data('lastname');
      var userFirstname = button.data('firstname');
      var modal = $(this);
      /*
       * La fonction find trouve un élément dont l'id ou (ici) la classe est passée en paramètre.
       * La fonction append permet de créer un élément dans l'élément apposé devant.
       * Ici dans la div modal-body, on crée un paragraphe qui contient la question de confirmation.
       */
      modal.find('.modal-body').append('<p>' + userFirstname + ' ' + userLastname + ' confirmez-vous la suppresion de votre compte ? </p>');
      modal.find('.modal-footer').append('<a href="liste-patients.php?deleteId=' + userId + '" class="btn btn-danger">Supprimer </a>');
   })
})
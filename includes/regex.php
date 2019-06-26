<?php
//Nom simple
$regexName = '#^([A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)([- ]{1}[A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+){0,1}$#';
// Texte avec espace _ nom de service , titre de poste - ne gére pas les chiffres
$regexNameService = '#^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ\-\ \']+$#';
//Date de naissance
$regexBirthDate = '#^(((19|20)[0-9]{2})\-{1}(0[1-9]{1}|1[0-2]{1})\-(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1}))$#';
// Adresse postale 
$regexAddress = '#^[0-9a-zA-ZÀ-ÖØ-öø-ÿ\.,\-\' \n]+$#';
//remplacé par la fonction filter_var en php
$regexMail = '#^([a-zA-Z0-9À-ÖØ-öø-ÿ\.\-\_]+)@([a-zA-Z0-9À-ÖØ-öø-ÿ\-\_\.]+)\.([a-zA-Z\.]{2,250})$#';
//Numéro de téléphone avec espace 
$regexPhoneNumber = '#^([0][1-79]){1}([ ][0-9]{2}){4}$#';
$regexZipCode = '#^[0-9]{5}$#';
$regexSearch = '#^[0-9]+$#';
$regexSiren = '#^(\d{9}|\d{3}[ ]\d{3}[ ]\d{3})$#';
?>
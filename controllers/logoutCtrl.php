<?php
isset($_SESSION)? '' : session_start();
//appel à la class autoloader
// Pour être plus efficace on vide d'abord le tableau de donnée de $_SESSION
// Détruit toutes les variables de session
$_SESSION = array();

//La session se détruit, on est déconnecté
session_destroy();

header('location: ../index.php');
exit();


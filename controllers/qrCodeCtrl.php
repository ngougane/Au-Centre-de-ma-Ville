<?php
/**
 * appel à la class autoloader 
 * sa méthode permet de charger de manière dynamique les classes 
 * dès qu'elles sont instanciés
 */
require_once 'models/autoloader.php';
autoloader::registrer();

/* 
 * Création du QrCode
 * appel de la bibliothèque qrlib
 */

require '../assets/phpqrcode/qrlib.php';

$user = new users();

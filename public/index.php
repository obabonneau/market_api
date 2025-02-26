<?php

// AFFICHAGE DES ERREURS PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);

// UTILISATION DE CLASSES
require_once "../app/Core/Router.php";

// INSTANCIATION D'UN OBJET "routeur"
$routeur = new Router();

// UTILISATION DE LA METHODE "routes" DE L'OBJET
$routeur->routes();
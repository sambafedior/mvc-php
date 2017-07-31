<?php
//Chargement de la bibliothèque
require "lib/mvc.php";

//Définition des variables
$name = "toto";
$pageTitle = "Accueil";

//liste de tous les fichiers dans /data
$fileList = glob("data/*.json");

//Récupération de la vue
$html = getRenderedView("home", [
    "pageTitle" => $pageTitle,
    "name" => $name,
    "list" => $fileList
]);

//Affichage de la vue
echo $html;
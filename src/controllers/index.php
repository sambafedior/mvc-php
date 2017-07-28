<?php
//Définition des variables
$name = "toto";
$pageTitle = "Accueil";

//liste de tous les fichiers dans /data
$fileList = glob(ROOT_PATH."/data/*.json");

//Récupération de la vue
$html = getRenderedView("home", [
    "pageTitle" => $pageTitle,
    "name" => $name,
    "list" => $fileList
]);

//Affichage de la vue
echo $html;
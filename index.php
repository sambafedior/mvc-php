<?php
//chargement de la bibliotheque
require "lib/mvc.php";

//Definition des variables
$name = "Samba";
$pageTitle = "Acceuil";


//liste de tous les fichiers dans le dossier data
$fileList = glob("data/*.json");

//recuperation de la vue
$html = getRenderedView("home", [
    "pageTitle" => $pageTitle,
    "name" => $name,
    "list" => $fileList

]);

//Affichage de la vue
echo $html;
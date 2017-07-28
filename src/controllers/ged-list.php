<?php
session_start();

//Chargement de la bibliothèque mvc
require "lib/mvc.php";

//chargement du modèle
require "models/ged-model.php";

$documenList = getDocumentList("data/documents.json");

//Affichage de la vue
echo getRenderedView("ged/list", ["documentList" => $documenList]);
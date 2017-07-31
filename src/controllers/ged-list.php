<?php
session_start();

//chargement du modèle
require MODEL_PATH."/ged-model.php";

$documenList = getDocumentList(ROOT_PATH."/data/documents.json");

//Affichage de la vue
echo getRenderedView("ged/list", ["documentList" => $documenList]);
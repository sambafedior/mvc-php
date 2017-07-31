<?php

//Définition des constantes
define("ROOT_PATH", dirname(__DIR__));
define("WEB_PATH", __DIR__);
define("SRC_PATH", ROOT_PATH."/src");
define("VIEW_PATH", SRC_PATH."/views");
define("CTRL_PATH", SRC_PATH."/controllers");
define("MODEL_PATH", SRC_PATH."/models");

//chargement des constante (connexion à la data base)
require  SRC_PATH."/conf/const.php";

//chargement de la bilbliothèque mvc
require ROOT_PATH. "/lib/mvc.php";

//récupération de la liste des routes
$routes = require SRC_PATH."/conf/routes.php";

$url = filter_input(INPUT_GET, "c", FILTER_SANITIZE_URL);

//Ajout du caractère / initial s'il n'existe pas
if(substr($url, 0,1) != "/"){
    $url = "/". $url;
}

dispatch($url, $routes);

//require CTRL_PATH."/{$controller}.php";
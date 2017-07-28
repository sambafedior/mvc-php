<?php
/**
 * @param $view
 * @param array $data
 * @return mixed
 */
function getViewContent($view, array $data = [])
{
//Mise en tampon du résultat de l'interpréteur PHP
    ob_start();
//Exportation des variables
    extract($data);
//inclusion de la vue
    require VIEW_PATH . "/{$view}.php";
//Récupération du contenu du tampon dans une variable
    $viewContent = ob_get_clean();
    return $viewContent;
}

/**
 * @param $view
 * @param array $data
 * @param string $layout
 * @return mixed
 */
function getRenderedView($view, array $data = [], $layout = "default-layout")
{
//Récupération du contenu de la vue
    $viewContent = getViewContent($view, $data);
//Ajout de la vue aux données
    $data["viewContent"] = $viewContent;
//Obtention du layout
    $rendered = getViewContent($layout, $data);
    return $rendered;
}

/**
 * execute une action dans un fichier controleur
 * @param string $url
 * @param array $routes
 */
function dispatch(string $url, array $routes)
{
    //obtention des information de routage
    $routeInfo = getRouteInfo($url, $routes);

    //chargement du fichier controleur

    require SRC_PATH . "/" . $routeInfo["controller"] . "php";

    //execution de l'action
    $routeInfo["action"](...$routeInfo["params"]);


    //autres possibilite
    //call_user_func($routeInfo["action"](...$routeInfo["params"]);

}

function getRouteInfo(string $url,array $routes):array {
    $routeInfo = [
        "controller" => "error",
        "action" => "notFoundAction",
        "params" => []
    ];

    foreach ($routes as $path => $target){
        $path = "#{$path}#";
        if(preg_match($path,$url, $matches)){
            //recuperation de l'action et du controleur
            $parts = explode(":", $target);
            //elimination du premier element
            array_shift($matches);

            $routeInfo["controller"]= $parts[0];
            $routeInfo["action"] = $parts[1];
            $routeInfo["params"] = $matches;

            break;

        }
    }
    return $routeInfo;
}
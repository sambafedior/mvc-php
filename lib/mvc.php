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
 * Exécute un action dans un fichier contrôleur
 * en passant les éventuels paramètres
 * @param string $url
 * @param array $routes
 */
function dispatch(string $url, array $routes)
{
    //Obtention des informations de routage
    $routeInfo = getRouteInfo($url, $routes);

    //Chargement du fichier contrôleur
    require CTRL_PATH . "/" . $routeInfo["controller"] . ".php";

    //Exécution de l'action
    $routeInfo["action"](...$routeInfo["params"]);

    //autre possibilite
    //call_user_func_array($routeInfo["action"],$routeInfo["params"] );
}

/**
 * @param string $url
 * @param array $routes
 * @return array
 */
function getRouteInfo(string $url, array $routes): array
{
    $routeInfo = [
        "controller" => "error",
        "action" => "notFoundAction",
        "params" => []
    ];

    foreach ($routes as $path => $target) {
        $route = "#^{$path}$#";

        if (preg_match($route, $url, $matches)) {
            //Récupération de l'action et du contrôleur
            $parts = explode(":", $target);
            //élimination du premier élément du tableau des correspondances
            array_shift($matches);

            $routeInfo["controller"] = $parts[0];
            $routeInfo["action"] = $parts[1];
            $routeInfo["params"] = $matches;

            break;
        }
    }

    return $routeInfo;
}

/** fonction à la connexion à la base de données
 * @return PDO
 */
function getPDO():PDO {
    return new PDO(
        DSN,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}

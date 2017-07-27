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
    require "views/{$view}.php";
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
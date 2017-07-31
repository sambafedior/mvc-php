<?php

function index()
{
    require MODEL_PATH . "/catalogue-model.php";

    $connexion = getPDO();
    $resultSet = $connexion->query("select * from vue_catalogue");

    echo getRenderedView(
        "catalogue/liste", ["resultSet" => $resultSet, "catalogue" => getAll()]);
}

function getBookByAuthor($name)
{
    require MODEL_PATH . "/catalogue-model.php";

    $connexion = getPDO();

    $statement = getBooksByAuthors($name);

    echo getRenderedView(
        "catalogue/getBookByAuthor", ["catalogue" =>$statement]

    );
}
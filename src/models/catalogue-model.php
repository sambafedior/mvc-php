<?php
/**
 * récuperé l'ensemble des donnees du catalogue des livre
 * @return array
 */
function getAll()
{
    $connexion = getPDO();
    $resultSet = $connexion->query("select * from vue_catalogue");

    return $resultSet->fetchAll(PDO::FETCH_ASSOC);

}

/**
 * liste des livres d'un auteur
 * @param $name
 * @return array+
 */
function getBooksByAuthors($name)
{  //connexion à la base de donnees
    $connexion = getPDO();
    //preparation et requete SQL
    $statement = $connexion->prepare("select * from vue_catalogue where nom=:nom");
    $statement->bindParam('nom', $name, PDO::PARAM_STR);
    //execution de la requete SQL
    $statement->execute();
    //récupération des données
    return $statement->fetchAll(PDO::FETCH_ASSOC);

}
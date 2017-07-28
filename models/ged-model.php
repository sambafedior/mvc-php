<?php

/**
 * Validation de la saisie du formulaire
 * d'enregistrement d'un nouveau document
 * @param string $title
 * @param array $upload
 * @return array
 */
function validateForm(string $title, array $upload): array {
    $errors = [];
    //Titre requis
    if(empty($title)){
        $errors[] = "Vous devez saisir un titre";
    }
    //Fichier requis
    if(isset($upload["name"]) &&empty($upload["name"])){
        $errors[] = "Vous devez choisir un fichier";
    }

    return $errors;
}

/**
 * Gère l'upload des documents
 * @param array $upload
 * @return array
 */
function handleUpload(array $upload):array{
    $uploadInfo = [];
    $errors = [];

    //Type de fichiers supportés
    $allowedTypes = [
        "application/pdf" => "pdf",
        "application/vnd.ms-excel" => "xls",
        "application/msword" => "doc",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document" => "docx",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" => "xlsx"
    ];

    //Test du type de fichier
    if(! array_key_exists($upload["type"], $allowedTypes)){
        $errors [] = "Le type de fichier n'est pas supporté";
    }

    if(count($errors) == 0){
        //Récupération de l'extension du fichier
        $extension = $allowedTypes[$upload["type"]];
        //Définition du nom du fichier
        $fileName = uniqid("doc_"). ".". $extension;
        $filePath = ROOT_PATH."/uploadedDocs/$fileName";

        //Copie du fichier temporaire
        if(! move_uploaded_file($upload["tmp_name"], $filePath)){
            $errors[] = "Impossible de copier le fichier";
        } else {
            $uploadInfo["fileName"] = $fileName;
        }
    }

    $uploadInfo["errors"] = $errors;

    return $uploadInfo;
}

/**
 * Récupération des données du fichier json sous la forme d'un tableau
 * @param string $documentPath
 * @return array
 */
function getDocumentList(string $documentPath): array{
    $data = [];
    if(file_exists($documentPath)){
        $data = json_decode(file_get_contents($documentPath), true);
    }

    return $data;
}

/**
 * @param array $documentList
 * @param string $title
 * @return bool
 */
function titleAlreadyExists(array $documentList, string $title): bool{

    $document = array_filter($documentList, function ($item) use($title){
        return $item["title"] == $title;
    });

    return count($document) >0;
}

/**
 * @param string $targetPath
 * @param array $data
 */
function saveDocument(string $targetPath, array $data){
    file_put_contents($targetPath, json_encode($data));
}
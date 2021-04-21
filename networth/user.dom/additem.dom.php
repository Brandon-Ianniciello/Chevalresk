<?php
    session_start();

    require_once __DIR__ . "/../utils/utilbundle.php";
    require_once __DIR__ . "/../classes/Items/Item.php";
    require_once __DIR__ . "/../classes/Items/ItemTDG.php";

    $sess_status = validate_session();

    $required_sess_status = true; 

    if($sess_status != $required_sess_status)
    {
        http_response_code(401);
        header("Location: ../user/login.php");
        die();
    }

    $post_params = ["nomItem","quantiteStockItems","typeItem","prixItem","photoItem"];
    validate_param($_POST, $post_params);

    $nomItem = sanitize($_POST["nomItem"]);
    $quantite = sanitize($_POST["quantiteStockItems"]);
    $type = sanitize($_POST["typeItem"]);
    $prix = sanitize($_POST["prixItem"]);
    $photo = sanitize($_POST["photoItem"]);

    $item = new Item();

    if(!$item->ajouter_item($nomItem,$quantite,$type,$prix,$photo)){
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
   
    header("Location: ../user/billboard.php");
    die();
?>
<?php
    session_start();

    require_once __DIR__ . "/../utils/utilbundle.php";
    require_once __DIR__ . "/../classes/Panier/Panier.php";
    require_once __DIR__ . "/../classes/Items/Item.php";


    $sess_status = validate_session();

    $required_sess_status = true; 

    if($sess_status != $required_sess_status)
    {
        http_response_code(401);
        header("Location: ../user/login.php");
        die();
    }

    $get_params = ["idItem"];
    validate_param($_GET, $get_params);

    //idItem
    if(isset($_GET['idItem']))
        $idItem = $_GET['idItem']; 
    else{
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
    
    $panier = new Panier();

    if(!$panier->supprimer_item_panier($idItem)){
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
    
    //ajuter le compteur d'items
    $_SESSION["nbrItemsPanier"]--;

    header("Location: ../user/inventaire.php");
    die();

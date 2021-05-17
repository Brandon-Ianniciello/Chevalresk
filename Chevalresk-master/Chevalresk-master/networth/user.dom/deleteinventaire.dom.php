<?php
    session_start();

    require_once __DIR__ . "/../utils/utilbundle.php";
    require_once __DIR__ . "/../classes/Inventaire/Inventaire.php";
    require_once __DIR__ . "/../classes/Items/Item.php";


    $sess_status = validate_session();

    $required_sess_status = true; 

    if($sess_status != $required_sess_status)
    {
        http_response_code(401);
        header("Location: ../user/login.php");
        die();
    }

    //idItem
    if(isset($_GET['idItem']))
        $idItem = $_GET['idItem']; 
    else{
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
    
    $inventaire = new Inventaire();

    if(!$inventaire->supprimer_item_inventaire($idItem)){
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
    
    $_SESSION["nbrItemsInventaire"]--;

    header("Location: ../user/inventaire.php");
    die();
?>
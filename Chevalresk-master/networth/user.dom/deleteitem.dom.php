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

    if(isset($_GET["nomItem"])){
        $nomItem = sanitize($_GET["nomItem"]);
    }
    else
        $nomItem = null;

    if(isset($_GET["type"])){
        $type = sanitize($_GET["type"]);
    }
    else
       $type = null;

    $item = new Item();

    if(!$item->supprimer_item($nomItem,$type)){
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
   
    header("Location: ../user/billboard.php");
    die();
?>
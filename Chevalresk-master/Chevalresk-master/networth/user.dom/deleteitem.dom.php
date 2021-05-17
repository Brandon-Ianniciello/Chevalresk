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

    if(isset($_GET["id"])){
        $id = sanitize($_GET["id"]);
    }
    else
        $id = null;

    $item = new Item();

    var_dump($id);

    if(!$item->supprimer_item($id)){
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
    
    header("Location: ../user/billboard.php");
    die();
?>
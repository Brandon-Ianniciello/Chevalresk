<?php

    session_start();

    require_once __DIR__ . "/../classes/user/user.php";
    require_once __DIR__ . "/../utils/utilbundle.php";

    //regarde si la session est valide
    $sess_status = validate_session();

    $required_sess_status = true; 

    if($sess_status != $required_sess_status){
        http_response_code(401); 
        echo ("error 401: unauthorized");
        die();
    }

    $post_params = ['oldpw', 'newpw', 'pwValidation'];
    validate_param($_POST, $post_params);

    $oldpw = sanitize($_POST["oldpw"]);
    $newpw = sanitize($_POST["newpw"]);
    $pwval = sanitize($_POST["pwValidation"]);

    if(!validate_password($newpw)){
        header("Location: ../error.php?ErrorMSG=invalid%20password");
        die();
    }
    
    $user = new User();
    if(!$user->update_user_pw($_SESSION["userEmail"], $oldpw, $newpw, $pwval)){
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
    
    header("Location: ../user/billboard.php");
    die();
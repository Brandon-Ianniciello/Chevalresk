<?php
    session_start();

    require_once __DIR__ . "/../utils/utilbundle.php";

    //regarde si la session est valide
    $sess_status = validate_session();

    $required_sess_status = true; 

    if($sess_status != $required_sess_status){
        http_response_code(401); 
        echo ("error 401: unauthorized");
        die();
    }

    end_session();

    header("Location: ../user/login.php");

    die();
    







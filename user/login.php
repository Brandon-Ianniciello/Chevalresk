<?php
    session_start();

    require_once "../utils/utilbundle.php";

    //regarde si la session est valide
    $sess_status = validate_session();

    $required_sess_status = false; 

    if($sess_status != $required_sess_status){
        http_response_code(401);
        echo ("error 401: unauthorized");
        die();
    }

    $title = "login";

    $view_array = ["views/loginview.php"];
    
    include "../html/masterpage.php";
?>
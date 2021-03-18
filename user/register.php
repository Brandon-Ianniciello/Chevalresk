<?php

    session_start();
    require_once "../utils/utilbundle.php";

    //regarde si la session est valide
    $sess_status = validate_session();
    $required_sess_status = false; 

    $title = "Register";
    $view_array = ["views/registerview.php"];

    // include masterpage
    include "../html/masterpage.php";
    
?>   
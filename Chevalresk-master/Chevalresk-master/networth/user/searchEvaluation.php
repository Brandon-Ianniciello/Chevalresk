<?php

    session_start();

    require_once "../utils/utilbundle.php";
    require_once "../classes/Items/ItemTDG.php";
    require_once "../classes/Evaluation/EvaluationTDG.php";

    //regarde si la session est valide
    $sess_status = validate_session();

    $required_sess_status = true; 

    if($sess_status != $required_sess_status){
        http_response_code(401);
        header("Location: ../user/login.php?errmsg=Veuillez d'abord vous connecter");
        die();
    }

    $title = "Recherche d'√©valuations";  

    $view_array = ["views/searchEvaluationView.php"];

    include "../html/masterpage.php";
?>
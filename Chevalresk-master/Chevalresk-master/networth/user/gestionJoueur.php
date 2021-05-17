<?php
    session_start();

    require_once "../utils/utilbundle.php";
    require_once "../classes/Joueur/JoueurTDG.php";
    
    //regarde si la session est valide
    $sess_status = validate_session();

    $required_sess_status = true; 

    if($sess_status != $required_sess_status || $_SESSION['isAdmin'] == 0){
        http_response_code(401);
        header("Location: ../user/login.php?errmsg=Veuillez d'abord vous connecter");
        die();
    }

    $title = "Gestion des joueurs";

    $view_array = ["views/gestionJoueursView.php"];
    
    include "../html/masterpage.php";
?>

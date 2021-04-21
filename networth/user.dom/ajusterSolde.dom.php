<?php
    session_start();

    require_once __DIR__ . "/../utils/utilbundle.php";
    require_once __DIR__ . "/../classes/Joueur/Joueur.php";
    require_once __DIR__ . "/../classes/Joueur/JoueurTDG.php";

    $sess_status = validate_session();

    $required_sess_status = true; 

    if($sess_status != $required_sess_status)
    {
        http_response_code(401);
        header("Location: ../user/login.php");
        die();
    }

    /*Post montant */
    $post_params = ["montant"];
    validate_param($_POST, $post_params);

    /*Get alias*/
    if(isset($_GET['alias']))
        $alias = $_GET['alias'];
    else
        $alias = $_SESSION['userName'];

    $montant = sanitize($_POST["montant"]);

    $joueur = new Joueur();

    if(!$joueur->update_user_montant($montant,$alias)){
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
   
    header("Location: ../user/gestionJoueur.php");
    die();
?>
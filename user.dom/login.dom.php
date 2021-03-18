<?php
    session_start();

    require_once __DIR__ . "/../utils/utilbundle.php";
    require_once __DIR__ . "/../classes/Joueur/Joueur.php";

    //regarde si la session est valide
    $sess_status = validate_session();

    $required_sess_status = false; 

    if($sess_status != $required_sess_status){
        http_response_code(401);
        echo ("error 401: unauthorized");
        die();
    }

    // parameter check
    $post_params = ['email', 'password'];
    validate_param($_POST, $post_params);

    $email = sanitize($_POST['email']);
    $pw = sanitize($_POST['password']);

    $a_joueur = new Joueur();

    if($a_joueur->login($email, $pw)){
        login($a_joueur->get_id(), $a_joueur->get_courriel(), $a_joueur->get_username());
        header("Location: ../user/billboard.php");
    }
    else{
        header("Location: ../user/login.php?errmsg=Invalid credentials");
    }
    die();
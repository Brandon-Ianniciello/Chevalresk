<?php
    session_start();

    require_once __DIR__ . "/../utils/utilbundle.php";
    require_once __DIR__ . "/../classes/user/user.php";

    //regarde si la session est valide
    $sess_status = validate_session();

    $required_sess_status = false; 

    if($sess_status != $required_sess_status){
        http_response_code(401);
        echo ("error 401: unauthorized");
        die();
    }

    $post_params = ["alias","nom","prénom", "email","password","confirmpassword"];
    validate_param($_POST, $post_params);

    $alias = sanitize($_POST["alias"]);
    $prénom = sanitize($_POST['prénom']);
    $nom = sanitize($_POST['nom']);
    $email = sanitize($_POST['email']);
    $pw = sanitize($_POST['password']);
    $cpw = sanitize($_POST['confirmpassword']);

    if(!validate_email($email)){
        header("Location: ../user/register.php?errmsg=Invalid Email");
        die();
    }

    if(!validate_password($pw)){
        header("Location: ../user/register.php?errmsg=Invalid Password");
        die();
    }

    $joueur = new Joueur();

    if(!$joueur->register($alias,$prénom,$nom,$email, $pw, $cpw))
    {
        header("Location: ../error.php?ErrorMSG=invalid email or password");
        die();
    }
    
    header("Location: ../user/login.php");
    die();
?>
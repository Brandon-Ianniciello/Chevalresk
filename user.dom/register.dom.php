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

    $post_params = ["username", "email","password","confirmpassword"];
    validate_param($_POST, $post_params);

    $name = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $pw = sanitize($_POST['password']);
    $cpw = sanitize($_POST['confirmpassword']);

    // VALIDATE EMAIL
    if(!validate_email($email)){
        header("Location: ../user/register.php?errmsg=Invalid Email");
        die();
    }

    // ADD PW VALIDATION (AT LEAST 1 NUMBER, 1 LETTER, 1 SPECIAL CHAR)
    if(!validate_password($pw)){
        header("Location: ../user/register.php?errmsg=Invalid Password");
        die();
    }

    $a_user = new User();

    if(!$a_user->register($email, $name, $pw, $cpw))
    {
        header("Location: ../error.php?ErrorMSG=invalid email or password");
        die();
    }
    
    header("Location: ../user/login.php");
    die();

?>
    







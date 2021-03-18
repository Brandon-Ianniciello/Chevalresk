<?php

session_start();

require_once __DIR__ . "/../utils/utilbundle.php";
require_once __DIR__ . "/../classes/user/user.php";

//regarde si la session est valide
$sess_status = validate_session();

$required_sess_status = true; 

if($sess_status != $required_sess_status){
    http_response_code(401); 
    echo ("error 401: unauthorized");
    die();
}

$post_params = ['Nemail'];
//validate_param($_POST, $post_params);

$email = sanitize($_POST["Nemail"]);

if(empty($email)){
    header("Location: ../error.php?ErrorMSG=invalid email");
    die();
}

if(!empty($email) && validate_email($email)){//|| ??
    $newmail = $email;
}
else{
    $newmail = $_SESSION["userEmail"];
}

$user = new Joueur();

if(!$user->update_email_info($_SESSION["userEmail"], $newmail)){
    header("Location: ../error.php?ErrorMSG=invalid%20request");
    die();
}

//header("Location: ../user/billboard.php");
//die();
?>
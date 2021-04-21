<?php

session_start();

require_once __DIR__ . "/../utils/utilbundle.php";
require_once __DIR__ . "/../classes/Joueur/Joueur.php";

//regarde si la session est valide
$sess_status = validate_session();

$required_sess_status = true; 

if($sess_status != $required_sess_status){
    http_response_code(401); 
    header("Location: ../user/login.php");
    die();
}

$post_params = ['Nemail'];

$email = sanitize($_POST["Nemail"]);

if(empty($email)){
    header("Location: ../error.php?ErrorMSG=invalid email");
    die();
}

if(!empty($email) && validate_email($email)){
    $newmail = $email;
}
else{
    $newmail = $_SESSION["userEmail"];
}

$joueur = new Joueur();

if(!$joueur->update_email_info($_SESSION["userEmail"], $newmail)){
    header("Location: ../error.php?ErrorMSG=invalid%20request");
    die();
}

header("Location: ../user/update.php");
die();
?>
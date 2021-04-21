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

$post_params = ['Nusername'];
validate_param($_POST, $post_params);

$username = sanitize($_POST["Nusername"]);

if(empty($username)){
    header("Location: ../user/profile.php?ErrorMSG=Empty%username");
    die();
}

$user = new Joueur();

if(!$user->update_username_info($_SESSION["userName"],$username, $_SESSION["userID"])){
    header("Location: ../error.php?ErrorMSG=invalid%20request");
    die();
}

header("Location: ../user/update.php");
die();
?>
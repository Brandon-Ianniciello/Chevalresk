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

$post_params = ['Nusername'];
//validate_param($_POST, $post_params);

$username = sanitize($_POST["Nusername"]);

if(empty($username)){
    header("Location: ../error.php?ErrorMSG=invalid username");
    die();
}

if(!empty($username) && validate_email($username)){//|| ??
    $newusername = $username;
}
else{
    $newusername = $_SESSION["userName"];
}

$user = new Joueur();
$email = $_SESSION["userEmail"];

if(!$user->update_username_info($_SESSION["userName"],$newusername, $email)){
    header("Location: ../error.php?ErrorMSG=invalid%20request");
    die();
}

//header("Location: ../user/billboard.php");
//die();
?>
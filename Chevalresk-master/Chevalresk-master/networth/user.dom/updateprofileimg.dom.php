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

$post_params = ['Nphoto'];

$url = sanitize($_POST["Nphoto"]);
$j = new Joueur();

if(!exif_imagetype($url)) {
    header("Location: ../user/profile.php?ErrorMSG=invalid%20image");
    die();
}

if(!$j->update_user_photo($url,$_SESSION['userID'])){
    header("Location: ../user/profile.php?ErrorMSG=invalid%20image");
    die();
}

$_SESSION["userProfileImage"] = $url;
$j->set_photo($url);

header("Location: ../user/update.php");
die();
?>
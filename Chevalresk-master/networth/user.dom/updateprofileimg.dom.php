<?php

session_start();

require_once __DIR__ . "/../utils/utilbundle.php";

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

if(!exif_imagetype($url)) {
    header("Location: ../user/profile.php?ErrorMSG=invalid%20image");
    die();
}
else{
    $_SESSION["userProfileImage"] = $url;
}

header("Location: ../user/update.php");
die();
?>
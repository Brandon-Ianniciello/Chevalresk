<?php

session_start();

require_once __DIR__ . "/../utils/utilbundle.php";
require_once __DIR__ . "/../classes/Evaluation/EvaluationTDG.php";

//regarde si la session est valide
$sess_status = validate_session();

$required_sess_status = true;

if($sess_status != $required_sess_status){
    http_response_code(401); 
    header("Location: ../user/login.php");
    die();
}

$post_params = ["rating"];
validate_param($_POST, $post_params);

$NbrÉtoiles = sanitize($_POST['rating']);

if($NbrÉtoiles <= 0 || $NbrÉtoiles > 5)
{
    header("Location: ../user/billboard.php?ErrorMSG=Le nombre d'étoiles doit être entre 1 et 5");
    die();
}

header("Location: ../user/searchEvaluation.php?NbrÉtoiles=$NbrÉtoiles");
die();

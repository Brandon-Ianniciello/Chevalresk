<?php
session_start();

require_once __DIR__ . "/../utils/utilbundle.php";
require_once __DIR__ . "/../classes/Evaluation/Evaluation.php";

$sess_status = validate_session();

$required_sess_status = true;

if ($sess_status != $required_sess_status) {
    http_response_code(401);
    header("Location: ../user/login.php");
    die();
}

$post_params = ["commentaire","rate"];
validate_param($_POST, $post_params);

/*idITem*/
if (isset($_GET["idItem"]))
    $idItem = sanitize($_GET["idItem"]);
else{
    echo ("trouve pas le get de quantite");
    $idItem = null;
}

/*variables */
$commentaire = sanitize($_POST["commentaire"]);
$nbrÉtoiles = sanitize($_POST['rate']);
$idJoueur = $_SESSION["userID"];

$evaluation = new Evaluation();

if(!$evaluation->add_evalutaion($nbrÉtoiles,$commentaire,$idJoueur,$idItem)){
    // header("Location: ../error.php?ErrorMSG=Bad%20request");
    // die();
}

// header("Location: ../user/inventaire.php");
// die();
<?php
    session_start();

    require_once __DIR__ . "/../utils/utilbundle.php";
    require_once __DIR__ . "/../classes/Evaluation/Evaluation.php";

    $sess_status = validate_session();

    $required_sess_status = true; 

    if($sess_status != $required_sess_status || !$_SESSION['isAdmin'])
    {
        http_response_code(401);
        header("Location: ../user/login.php");
        die();
    }

    //idItem
    if(isset($_GET['idEvaluation']))
        $idEvaluation = $_GET['idEvaluation']; 
    else{
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
    
    $evaluation = new Evaluation();

    if(!$evaluation->supprimer_evaluations($idEvaluation)){
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }

    header("Location: ../user/billboard.php");
    die();
?>
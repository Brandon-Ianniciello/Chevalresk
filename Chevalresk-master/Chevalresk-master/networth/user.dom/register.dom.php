<?php

session_start();

require_once __DIR__ . "/../utils/utilbundle.php";
require_once __DIR__ . "/../classes/Joueur/Joueur.php";

//regarde si la session est valide
$sess_status = validate_session();

$required_sess_status = false;

if ($sess_status != $required_sess_status) {
    http_response_code(401);
    echo ("error 401: unauthorized");
    die();
}


$post_params = ["alias", "nom", "prenom", "email", "password", "confirmpassword"];
validate_param($_POST, $post_params);
var_dump('test');

$alias = sanitize($_POST["alias"]);
$prenom = sanitize($_POST['prenom']);
$nom = sanitize($_POST['nom']);
$email = sanitize($_POST['email']);
$pw = sanitize($_POST['password']);
$cpw = sanitize($_POST['confirmpassword']);


var_dump('email');
/*Regarde si l'email est valide*/
if (!validate_email($email)) {
    header("Location: ../user/register.php?errmsg=Invalid Email");
    die();
}

var_dump('pw');
/*Regarde si le mdp est valide*/
if (!validate_password($pw)) {
    header("Location: ../user/register.php?errmsg=Mot de passe invalide : doit contenir 1 nombre,1 charactere speciaux et 6 characteres minimum&email=".$email."&alias=".$alias."&prenom=".$prenom."&nom=".$nom."");
    die();
}

$joueur = new Joueur();

if (!$joueur->register($alias, $prénom, $nom, $email, $pw, $cpw)) {
    header("Location: ../user/login.php?errmsg=Invalid credentials");
    die();
}

header("Location: ../user/login.php");
die();

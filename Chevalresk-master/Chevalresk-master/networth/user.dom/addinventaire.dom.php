<?php
session_start();

require_once __DIR__ . "/../utils/utilbundle.php";
require_once __DIR__ . "/../classes/Inventaire/Inventaire.php";
require_once __DIR__ . "/../classes/Panier/Panier.php";
require_once __DIR__ . "/../classes/Items/ItemTDG.php";
require_once __DIR__ . "/../classes/Joueur/JoueurTDG.php";
require_once __DIR__ . "/../classes/Joueur/Joueur.php";

$sess_status = validate_session();

$required_sess_status = true;

if ($sess_status != $required_sess_status) {
    http_response_code(401);
    header("Location: ../user/login.php");
    die();
}

//quantite
if (isset($_GET["Quantite"]))
    $quantite = sanitize($_GET["Quantite"]);
else 
    $quantite = null;

//idItem
if (isset($_GET["idItem"]))
    $idItem = sanitize($_GET["idItem"]);
else
    $idItem=null;
    
//idJoeuur
$idJoueur = $_SESSION['userID'];

/*objets */
$inventaire = new Inventaire();
$panier = new Panier();
$joueur = new Joueur();

/*après on doit ajuster les gains du joeurs*/
$TDGJoueur = JoueurTDG::getInstance();
$res1 = $TDGJoueur->get_gains_by_id($idJoueur);
$gainsJoueur = $res1['montantInitial'];

$TDGItem = itemTDG::getInstance();
$prixItem = $TDGItem->get_prix_by_id($idItem);

/*total*/
$total = $quantite * $prixItem;

/*total du joueur*/
$totalJoueur = $gainsJoueur - $total;

/*soustraire le total aux gains du joueur*/
if ($totalJoueur < $total) {
    header("Location: ../user/panier.php?ErrorMSG=Solde%20insuffisants");
    die();
}

if(!$joueur->update_user_montant_by_id($totalJoueur, $idJoueur)){
    header("Location: ../user/panier.php?ErrorMSG=Impossible%20de%20changer%20le%20solde");
    die();
}

/*ajuster la variable de session*/
$_SESSION['userSolde'] = $totalJoueur;

if ($inventaire->ajouter_item_inventaire($idItem, $idJoueur, $quantite)) {

    /*si on a réussit à ajouter l'item à l'inventaire
          on doit l'enlever du panier*/
    if (!$panier->supprimer_item_panier($idItem)) {
        //ajuter le compteur d'items du panier
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }

    /*quantite*/
    $quantiteStock = $TDGItem->get_quantiteStock_by_id($idItem);
    $quantiteRestante = $quantiteStock - $quantite;

    /*soustraire la quantitedemande à la quantite en stock*/
    if (!$TDGItem->update_quantiteStock($idItem, $quantiteRestante)) {
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
} else {
    header("Location: ../error.php?ErrorMSG=Bad%20request");
    die();
}

header("Location: ../user/inventaire.php");
die();

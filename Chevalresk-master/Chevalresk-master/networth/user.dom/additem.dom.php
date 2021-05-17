<?php
session_start();

require_once __DIR__ . "/../utils/utilbundle.php";

require_once __DIR__ . "/../classes/Items/Item.php";
require_once __DIR__ . "/../classes/Items/ItemTDG.php";

require_once __DIR__ . "/../classes/Armes/Arme.php";

require_once __DIR__ . "/../classes/Armures/Armure.php";

require_once __DIR__ . "/../classes/Potions/Potion.php";

require_once __DIR__ . "/../classes/Ressources/Ressource.php";

$sess_status = validate_session();

$required_sess_status = true;

if ($sess_status != $required_sess_status) {
    http_response_code(401);
    header("Location: ../user/login.php");
    die();
}

$post_params = ["nomItem", "quantiteStockItems", "typeItem", "prixItem", "photoItem"];
validate_param($_POST, $post_params);

$nomItem = sanitize($_POST["nomItem"]);
$quantite = sanitize($_POST["quantiteStockItems"]);
$type = sanitize($_POST["typeItem"]);
$prix = sanitize($_POST["prixItem"]);
$photo = sanitize($_POST["photoItem"]);

/*--Vérifier le type de l'item-- */
if ($type == 'A') {
    /*--créer une nouvelle arme-- */
    $arme = new Arme();

    $post_paramsArmes = ["efficaciteArme", "genreArme", "descriptionArme"];
    validate_param($_POST, $post_paramsArmes);

    /*--variables de l'arme--*/
    $efficacite = sanitize($_POST['efficaciteArme']);
    $genre = sanitize($_POST['genreArme']);
    $descriptionArme = sanitize($_POST['descriptionArme']);

    /*--ajouter l'arme--*/
    if (!$arme->add_arme($efficacite, $genre, $descriptionArme)) {
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
}
if ($type == 'M') {
    /*--créer une nouvelle armure-- */
    $armure = new Armure();

    $post_paramsArmure = ["poidArmure", "tailleArmure", "matièreArmure"];
    validate_param($_POST, $post_paramsArmure);

    /*--variables de l'arme--*/
    $poids = sanitize($_POST['poidArmure']);
    $taille = sanitize($_POST['tailleArmure']);
    $matière = sanitize($_POST['matièreArmure']);

    /*--ajouter l'arme--*/
    if (!$armure->add_armure($poids, $taille, $matière)) {
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
}
if ($type == 'P') {
    /*--créer une nouvelle potion-- */
    $potion = new Potion();

    $post_paramsPotion = ["duréePotion", "effetPotion"];
    validate_param($_POST, $post_paramsPotion);

    /*--variables de la potion--*/
    $duréePotion = sanitize($_POST['duréePotion']);
    $effetPotion = sanitize($_POST['effetPotion']);

    /*--ajouter la potion--*/
    if (!$potion->add_potion($duréePotion, $effetPotion)) {
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
    
}
if ($type == 'R') {
    /*--créer une nouvelle ressource-- */
    $ressource = new Ressource();

    $post_paramsPotion = ["descriptionRessource"];
    validate_param($_POST, $post_paramsPotion);

    /*--variables de la potion--*/
    $description = sanitize($_POST['descriptionRessource']);

    /*--ajouter la potion--*/
    if (!$ressource->add_ressource($description)) {
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }
}

$item = new Item();

if (!$item->ajouter_item($nomItem, $quantite, $type, $prix, $photo)) {
    header("Location: ../error.php?ErrorMSG=Bad%20request");
    die();
}

header("Location: ../user/billboard.php");
die();

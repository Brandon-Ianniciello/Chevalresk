<?php
    session_start();

    require_once __DIR__ . "/../utils/utilbundle.php";
    require_once __DIR__ . "/../classes/Panier/Panier.php";
    require_once __DIR__ . "/../classes/Items/ItemTDG.php";


    $sess_status = validate_session();

    $required_sess_status = true; 

    if($sess_status != $required_sess_status)
    {
        http_response_code(401);
        header("Location: ../user/login.php");
        die();
    }

    //idItem
    if(isset($_GET['idItem']))
        $idItem = $_GET['idItem']; 
    else{
        header("Location: ../user/billboard.php?ErrorMSG=Id de l'item non trouvé");
        die();
    }

    $post_params = ["Quantite"];
    validate_param($_POST, $post_params);

    //quantite
    $quantite = sanitize($_POST["Quantite"]);
    
    //si la quantite demandé est plus petite que la quantite en stock => error
    $item = itemTDG::getInstance();
    $quantiteStock = $item->get_quantiteStock_by_id($idItem);

    if($quantite > $quantiteStock || $quantite <= 0){
        header("Location: ../user/billboard.php?ErrorMSG=Quantite en stock insuffisante");
        die();
    }

    //idJoeuur
    $idJoueur = $_SESSION['userID'];
    
    $panier = new Panier();

    if(!$panier->ajouter_item_panier($idItem,$idJoueur,$quantite)){
        header("Location: ../error.php?ErrorMSG=Bad%20request");
        die();
    }

    //ajuter le compteur d'items
    $_SESSION["nbrItemsPanier"]++;

    header("Location: ../user/panier.php");
    die();
?>
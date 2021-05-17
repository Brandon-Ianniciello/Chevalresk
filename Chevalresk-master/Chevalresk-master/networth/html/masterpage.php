<?php

//si l'utilisateur est connecté
if ($sess_status) {

    //profile image
    if (isset($_SESSION["userProfileImage"]))
        $urlPhotoProfil = $_SESSION["userProfileImage"];
    else {
        $_SESSION["userProfileImage"] = "../img/no_profile_pic.png";
        $urlPhotoProfil =  $_SESSION["userProfileImage"];
    }

    //username
    if (isset($_SESSION["username"]))
        $username = $_SESSION["username"];
    else
        $username = "";

    //solde
    if (isset($_SESSION["userSolde"]))
        $solde = $_SESSION["userSolde"];
    else
        $solde = "";

    //nbr item panier 
    if (isset($_SESSION["nbrItemsPanier"]))
        $nbrItemPanier = $_SESSION["nbrItemsPanier"];
    else
        $nbrItemPanier = 0;

    if (isset($_SESSION["nbrItemsInventaire"]))
        $nbrItemsInventaire = $_SESSION["nbrItemsInventaire"];
    else
        $nbrItemsInventaire = 0;

    /*Voir si l'internaute est l'administrateur*/
    if (isset($_SESSION['userID']))
        $idJoueur = $_SESSION['userID'];
    else
        $idJoueur = null;
    
    if (isset($_SESSION['isAdmin']))
        $isAdmin = $_SESSION['isAdmin'];
    else
        $isAdmin = 0;
        
    //Navbar lorsque connecter
    $nav = '
        <h1 id="titre">CHEVALRESK</h1>
            <ul class="navList">
                <li class="navItem"><a href="../user.dom/logout.dom.php" class="navA">Déconnexion</a></li>
                <li class="navItem">
                    <a href="../user/profile.php" class="navA">
                        <img class="rounded-circle"style="width:30px;height:30px;" src="' . $urlPhotoProfil . '">
                        '. $_SESSION['userName'] .'
                    </a>
                </li>

                <li class="navItem"><a href="../user/panier.php" class="navAicon">
                    <i class="shopping cart icon"></i>
                </a></li>
                <li class="navItem"><a href="../user/inventaire.php" class="navA">Inventaire</a></li>
                <li class="navItem"><a href="../user/billboard.php" class="navA">Items</a></li>
                <li class="navItem"><a style="color:#39ca74;;" class="navA">Solde: <b>' . $solde . '</b> ecu</a></li>
    ';

    if($isAdmin == 1){
        $nav .= '<li class="navItem"><a href="../user/gestionJoueur.php" class="navA">Gestion des joueurs</a></li>';
    }else{
        $nav .= '</ul>';
    }
}
//si l'utilisateur n'est pas connecté
else {
    $nav = '
        <h1 id="titre">CHEVALRESK</h1>
            <ul class="navList">
                <li class="navItem"><a href="../user/billboard.php"  class="navA">Items</a></li>
                <li class="navItem"><a href="../user/login.php" class="navA">Se connecter</a></li>
                <li class="navItem"><a href="../user/register.php" class="navA">Registraire</a></li>
            </ul>
    ';
}
?>
<!DOCTYPE HTML>

<html lang="fr">

<head>
<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1">
    <!--CSS CRÉER-->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Rateyo -->
    
    <!--ratings-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <!-- you can get from here https://github.com/antennaio/jquery-bar-rating -->
    <!-- <link href="plugins/star-ratting/fontawesome-stars.css" rel="stylesheet" type="text/css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="plugins/star-ratting/jquery.barrating.min.js" type="text/javascript"></script> -->
    
    <!--Fichier js-->
    <script type="text/javascript" src="../JS/etoiles.js"></script>
    <script type="text/javascript" src="/JS/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/JS/jquery-ui.js"></script>
    <script type="text/javascript" src="../JS/rating.js"></script>


    <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css"
     integrity="sha512-+AdxWMqfOdtwMuXK482e5OgHYzN06s97n3NTAeAdTlUvlIgCBx3SUKvMculJIedylDfVCaQFdD6HaojI4aeBUA==" 
     crossorigin="anonymous" />

    <!--Titre de la page-->
    <title> <?php echo $title ?></title>
</head>

<body class="fond-acueil">
    <!--entete-->
    <nav class="navbar">

        <?php
        echo $nav;
        ?>
    </nav>
    <div>
        <?php load_modules($view_array); ?>
    </div>

    <footer>
    </footer>
</body>

</html>
<?php

//si l'utilisateur est connecté
if ($sess_status) {
    if (isset($_SESSION["username"]))
        $username = $_SESSION["username"];
    else
        $username = "";

    $nav = " 
        <li class='nav-item'>
            <a class='nav-link' id='item' href='../user/profile.php'> 
                <img class='rounded-circle'style='width:20px;height:20px;' src='../img/temp.jpg'>
                MY PROFILE
            </a>
           
        </li>
        <li class='nav-item'>
            <a class='nav-link' id='item' href='../user.dom/logout.dom.php'>LOGOUT</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' id='item' href='../user/register.php'>REGISTER</a>
        </li>
        <!--Barre de recherche-->
            <li class='nav-item'>
                <form action='../search/search.dom.php' method='POST'>
                    <nav>
                        <div class='input-group mb-3'>
                        <input type='text'>
                        <button type='submit' class='btn btn-success'><img class='loupe'></button>
                        </div>
                    </nav>
                </form>
            </li>

        <li class='nav-item'>
            <a id='item' class='nav-link'>CONNECTÉ<span class='clignote'> •</span></a></a>
        </li>
        ";
}
//si l'utilisateur n'est pas connecté
else {
    $nav = '
        <li class="nav-item" id="item">
            <a class="nav-link" href="../user/login.php">LOGIN</a>
        </li>
        <li class="nav-item" id="item">
            <a class="nav-link" href="../user/register.php">REGISTER</a>
        </li>';

        $nav .= "
        <li class='nav-item' id='item'>
            <a class='nav-link'>DÉCONNECTÉ <span class='clignote'> •</span></a></a>
        </li>
        ";
}
?>

<!DOCTYPE HTML>

<html lang="fr">

<head>
    <meta name="viewport"  charset="UTF-8" content="width=device-width, initial-scale=1">
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

    <!--Titre de la page-->
    <title> <?php echo $title ?></title>
</head>

<body class="fond-acueil">
    <!--entete-->
    <nav class="navbar navbar-expand-sm bg-black navbar-black mb-4" id="entete">

        <div class="d-flex justify-content-around">

            <ul class="navbar-nav mr-auto">
                <!---logo du SN-->
                <li class="nav-item">
                    <h2 class="logo">CHEVALERESK</h2>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="item" href="../user/billboard.php">ITEMS</a>
                </li>
                
                <li class="nav-item" id="item">
                    <?php
                        echo $nav;
                    ?>
                </li>

            </ul>
        </div>
    </nav>

    <!---Afficher les éléments-->
    <div>
        <?php load_modules($view_array); ?>
    </div>

    <footer>
    </footer>
</body>

</html>
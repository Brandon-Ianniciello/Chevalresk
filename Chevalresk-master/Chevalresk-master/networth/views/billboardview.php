<?php

if (isset($_SESSION['userID']))
    $idJoueur = $_SESSION['userID'];
else
    $idJoueur = null;

/*Voir si l'internaute est l'administrateur*/
if (isset($_SESSION['isAdmin']))
    $isAdmin = $_SESSION['isAdmin'];
else
    $isAdmin = 0;

/*Variables */
$TDG = itemTDG::getInstance();

?>

<div class="divSearch">
    <h4 class="categorieRecherche">Recherche par categorie:</h4>
    <nav class="rechercheCat">
        <a href="../user/billboard.php" class="itemCat">Tous les items</a>
        <a href="../user/potion.php" class="itemCat">Potion</a>
        <a href="../user/arme.php" class="itemCat">Armes</a>
        <a href="../user/armure.php" class="itemCat">Armures</a>
        <a href="../user/ressources.php" class="itemCat">Ressources</a>
    </nav>

    <table class='tableRecherche'>
        <tr class="recherchePos">
            <td>
                <form method='POST'>
                    <input type='text' name='txtBox' placeholder="Recherche..." required autofocus>
                    <button type='submit' name='search' class='recherche-btn' style="width:50px;">
                        <i class="search icon"></i>
                    </button>
                </form>
            </td>
        </tr>
    </table>

    <form method="POST" action="../user.dom/searchEvaluations.dom.php">
        <table class='tableRecherche'>
            <tr class="recherchePos">
                <td>
                    <div class="rateyo" id="rating" style="padding-left:44.5%" data-rateyo-rating="0" data-rateyo-num-stars="5" data-rateyo-score="3" data-rateyo-full-star="true">
                    </div>
                    <input type="hidden" name="rating">
                    <button type='submit' name='ratingSearch' style="width:50px;" class='recherche-btn'>
                        <i class="search icon"></i>
                    </button>
                </td>
            </tr>
        </table>
    </form>

    <?php
    if ($isAdmin == 1) {
        echo "
                <br>
                <br>
                <td>
                    <ul>
                        <h2><a href='../user/addItem.php'>Ajouter un item<i class='plus icon'></i></a></h2>
                    </ul>
                </td>
            ";
    }
    ?>

    <h3 class='intro'>TOUS LES ITEMS</h3>
</div>
<br>

<?php

if (isset($_GET['ErrorMSG'])) {
    $msg_error = $_GET['ErrorMSG'];
    echo "<div class='pt-3 text-danger'>
        <h5>$msg_error</h5>
    </div>";
}

/*Si il y a une recherche*/
if (isset($_POST['search'])) {
    $recherche = $_POST['search'];
    $itemName = $TDG->get_by_nom($_POST['txtBox']);
    $res = $TDG->get_all_info_by_name($itemName);

    //si la recherche est invalide
    $table = "<div class='container'><h4 class='sous-titre'>RÉSULTAT POUR LA RECHERCHE :</h4>";
    foreach ($res as $column => $item) {
        $idItem = $item['idItem'];
        if ($item['quantiteStockItems'] <= 0) {
            $table .= "<a style='color:black;' href='../user/details.php?id=$idItem'><div class='col-4'>";
            $table .= "<div class='col'>";
            $table .= '<img class="imageItem" src="' . $item['photoItem'] . '">';
            $table .= '<h4 id="data"><a style="color:red;">RUPTURE DE STOCK</a></h4>';
            $table .= '<h4 class="nomItem">' . $item['nomItem'] . '</h4><p class="prixItem">Prix: ' . $item['prixItem'] . '</p>';
        } else {
            $table .= "<a style='color:black;' href='../user/details.php?id=$idItem'><div class='col-4'>";
            $table .= "<div class='col'>";
            $table .= '<img class="imageItem" src="' . $item['photoItem'] . '">';
            $table .= '<h4 class="nomItem">' . $item['nomItem'] . '</h4><p class="prixItem">Prix: ' .
                $item['prixItem'] . '</p>';

            $table .= "<a class='addPanier' href='../user/panier.php?id=$idItem idJoueur=$idJoueur'>Ajouter au panier<i class='cart arrow down icon'></i></a>";
            $table .= '<h4 class="qtStock">Quantité en stock:' . $item['quantiteStockItems'] . '</h4></a>';
        }

        if ($isAdmin) {
            $table .= '
            <button type="button" class="btn btn-danger btn-sm">
            <a style="color:white" href="../user.dom/deleteitem.dom.php?id=' . $idItem . '">
            <i class="trash icon"></i>
            </a>
            </button>';
        }
        $table .= '</div> </div>';
    }
    $table .= ' </table></div>';
    echo $table;

    echo '<br><a href="../user/billboard.php">Retour à la liste</a>';
} 
else if (!isset($_POST['search'])) {
    $res = $TDG->get_all_items();
    $table = "<div class='row'>";
    foreach ($res as $column => $item) {
        $idItem = $item['idItem'];
        if ($item['quantiteStockItems'] <= 0) {
            $table .= "<a style='color:black;' href='../user/details.php?id=$idItem'><div class='col-4'>";
            $table .= "<div class='col'>";
            $table .= "
            <table class='container'>
                <tr>
                    <td>
                        <b> ". $item['moyenneÉvaluation'] ." </b>
                    </td>
                    <td>
                        <div class='rateyo' id='rating' data-rateyo-read-only='true' data-rateyo-num-stars='1'data-rateyo-half-star='true' data-rateyo-normal-fill='orange'>
                        </div>
                    </td>
                </tr>
            </table>";
            $table .= '<img class="imageItem" src="' . $item['photoItem'] . '">';
            $table .= '<h4 id="data"><a style="color:red;">RUPTURE DE STOCK</a></h4>';
            $table .= '<h4 class="nomItem">' . $item['nomItem'] . '</h4><p class="prixItem">Prix: ' . $item['prixItem'] . '</p>';
            
        } else {
            $table .= "<a style='color:black;' href='../user/details.php?id=$idItem'><div class='col-4'>";
            $table .= "<div class='col'>";

            $table .= "
            <table class='container'>
                <tr>
                    <td>
                        <b> ". $item['moyenneÉvaluation'] ." </b>
                    </td>
                    <td>
                        <div class='rateyo' id='rating' data-rateyo-read-only='true' data-rateyo-num-stars='1'data-rateyo-half-star='true' data-rateyo-normal-fill='orange'>
                        </div>
                    </td>
                </tr>
            </table>";

            $table .= '<img class="imageItem" src="' . $item['photoItem'] . '">';
            $table .= '<h4 class="nomItem">' . $item['nomItem'] . '</h4><p class="prixItem">Prix: ' . $item['prixItem'] . '</p>';
            $table .= "<a class='addPanier' href='../user/panier.php?id=$idItem idJoueur=$idJoueur'>Ajouter au panier<i class='cart arrow down icon'></i></a>";
            $table .= '<h4 class="qtStock">Quantité en stock:' . $item['quantiteStockItems'] . '</h4></a>';
        }

        if ($isAdmin) {
            $table .= '
            <button type="button" class="btn btn-danger btn-sm">
            <a style="color:white" href="../user.dom/deleteitem.dom.php?id=' . $idItem . '">
            <i class="trash icon"></i>
            </a>
            </button>';
        }

        $table .= '</div> </div>';
    }

    $table .= ' </table></div>';
    echo $table;
}

?>
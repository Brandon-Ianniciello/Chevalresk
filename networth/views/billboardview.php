<?php
if (isset($_SESSION['userID']))
    $idJoueur = $_SESSION['userID'];
else
    $idJoueur = null;

/*Voir si l'internaute est l'administrateur*/
if(isset($_SESSION['isAdmin']))
    $isAdmin =$_SESSION['isAdmin'];
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
            <?php
            if ($isAdmin == 1) {
                echo "
                <td>
                    <ul>
                        <li><a href='../user/addItem.php'>AJOUTER UN ITEM</a></li>
                    </ul>
                </td>
            ";
            } 
            ?>
            <td>
                <form method='POST'>
                    <label>Recherche</label>
                    <input type='text' name='txtBox' required autofocus>
                    <input type='submit' name='search' class='recherche-btn' value="Rechercher" placeholder="Écrire ici pour faire une recherche">
                </form>
            </td>
        </tr>
    </table>
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
    // if ($_POST['search'] != "Rechercher") {
    $table = "<div class='container'><h4 class='sous-titre'>RÉSULTAT POUR LA RECHERCHE :</h4>";
    foreach ($res as $column => $item) {
        $idItem = $item['idItem'];

        if ($item['quantiteStockItems'] <= 0) {
            $table .= "<a style='color:black;' href='../user/details.php?id=$idItem&&idJoueur=$idJoueur'><div class='col-4'>";
            $table .= "<div class='col'>";
            $table .= '<img class="imageItem" src="' . $item['photoItem'] . '">';
            $table .= '<h4 id="data"><a style="color:red;">RUPTURE DE STOCK</a></h4>';
            $table .= '<h4 class="nomItem">' . $item['nomItem'] . '</h4><p class="prixItem">Prix: ' . $item['prixItem'] . '</p>';
        } else {
            $table .= "<a style='color:black;' href='../user/details.php?id=$idItem&&idJoueur=$idJoueur'><div class='col-4'>";
            $table .= "<div class='col'>";
            $table .= '<img class="imageItem" src="' . $item['photoItem'] . '">';
            $table .= '<h4 class="nomItem">' . $item['nomItem'] . '</h4><p class="prixItem">Prix: ' .
                $item['prixItem'] . '</p>';

            $table .= "<a class='addPanier' href='../user/panier.php?id=$idItem idJoueur=$idJoueur'>AJOUTER AU PANIER</a>";
            $table .= '<h4 class="qtStock">Quantité en stock:' . $item['quantiteStockItems'] . '</h4></a>';
        }

        if ($isAdmin) {
            $table .= '
            <button type="button" class="btn btn-danger btn-sm">
            <a style="color:white" href="../user.dom/deleteitem.dom.php?nomItem='. $item['nomItem'] .'&&type='. $item['typeItem'] .'">
                <span class="glyphicon glyphicon-remove"></span> Remove 
            </a>
            </button>';
        }

        $table .= '</div> </div>';
    }
    // }
    // else{
    //     $table = "<div><table><td>Aucun résultats :(<td>"; 
    // }

    $table .= ' </table></div>';
    echo $table;
    echo '<a href="../user/billboard.php">Retour à la liste</a>';
}

else if (!isset($_POST['search'])) {
    $res = $TDG->get_all_items();
    $table = "<div class='row'>";
    foreach ($res as $column => $item) {
        $idItem = $item['idItem'];
        if ($item['quantiteStockItems'] <= 0) {
            $table .= "<a style='color:black;' href='../user/details.php?id=$idItem&&idJoueur=$idJoueur'><div class='col-4'>";
            $table .= "<div class='col'>";
            $table .= '<img class="imageItem" src="' . $item['photoItem'] . '">';
            $table .= '<h4 id="data"><a style="color:red;">RUPTURE DE STOCK</a></h4>';
            $table .= '<h4 class="nomItem">' . $item['nomItem'] . '</h4><p class="prixItem">Prix: ' . $item['prixItem'] . '</p>';
        } else {
            $table .= "<a style='color:black;' href='../user/details.php?id=$idItem&&idJoueur=$idJoueur'><div class='col-4'>";
            $table .= "<div class='col'>";
            $table .= '<img class="imageItem" src="' . $item['photoItem'] . '">';
            $table .= '<h4 class="nomItem">' . $item['nomItem'] . '</h4><p class="prixItem">Prix: ' . $item['prixItem'] . '</p>';
            $table .= "<a class='addPanier' href='../user/panier.php?id=$idItem idJoueur=$idJoueur'>AJOUTER AU PANIER</a>";
            $table .= '<h4 class="qtStock">Quantité en stock:' . $item['quantiteStockItems'] . '</h4></a>';
        }

        if ($isAdmin) {
            $table .= '
            <button type="button" class="btn btn-danger btn-sm">
            <a style="color:white" href="../user.dom/deleteitem.dom.php?nomItem='. $item['nomItem'] .'&&type='. $item['typeItem'] .'">
                <span class="glyphicon glyphicon-remove"></span> Remove 
            </a>
            </button>';
        }

        $table .= '</div> </div>';
    }

    $table .= ' </table></div>';
    echo $table;
}
?>
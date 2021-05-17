<?PHP

if (isset($_SESSION['userID']))
    $idJoueur = $_SESSION['userID'];
else
    $idJoueur = null;

if(isset($_SESSION['isAdmin']))
    $isAdmin =$_SESSION['isAdmin'];
else
    $isAdmin = 0;
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
</div>
<br>

<h3 class='intro'>TOUS LES ARMES</h3>

<?php

/*AFFICHER TOUT LES ARMES*/
$TDG = ItemTDG::getInstance();
$res = $TDG->get_all_items();
$table = "<div class='row'>";
foreach ($res as $column => $item) {
    if ($item['typeItem'] == 'a'||$item['typeItem'] == 'A' ) {
        $idItem = $item['idItem'];
        if ($item['quantiteStockItems'] <= 0){
            $table .= "<a style='color:black;' href='../user/details.php?id=$idItem idJoueur=$idJoueur'><div class='col-4'>";
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
        }
       
        else{
            $table .= "<a style='color:black;' href='../user/details.php?id=$idItem idJoueur=$idJoueur'><div class='col-4'>";
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
            <a style="color:white" href="../user.dom/deleteitem.dom.php?id='. $idItem .'">
            <i class="trash icon"></i>
            </a>
            </button>';
        }

        $table .= '</div> </div>';
    }
}

$table .= ' </table></div>';
echo $table;
?>
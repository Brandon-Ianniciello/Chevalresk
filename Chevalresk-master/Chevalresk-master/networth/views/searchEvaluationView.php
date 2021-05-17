<?php
/* VARIABLES */
$TDG = itemTDG::getInstance();

if (isset($_SESSION['isAdmin']))
    $isAdmin = $_SESSION['isAdmin'];
else
    $isAdmin = false;

if (isset($_SESSION['userID']))
    $idJoueur = $_SESSION['userID'];
else
    $idJoueur = null;

if (isset($_GET['NbrÉtoiles'])) {
    $nbrÉtoiles = $_GET['NbrÉtoiles'];

    /*Si il y a une rechercher par évaluation */
    $table = "<div class='row'>";
    $table .= "<h2 class='container'>RECHERCHE DE TOUT LES ITEMS À : " . $nbrÉtoiles . " ÉTOILES</h2><br>";
    $res = $TDG->get_all_by_moyenne($nbrÉtoiles); //4

    foreach ($res as $column => $item) {
        $idItem = $item['idItem'];
        $res = $TDG->get_all_info_by_id($idItem);
        foreach ($res as $column => $item) {
            $idItem = $item['idItem'];
            if ($item['quantiteStockItems'] <= 0) {
                $table .= "<a style='color:black;' href='../user/details.php?id=$idItem'><div class='col-4'>";
                $table .= "<div class='col'>";
                $table .= "
                <table class='container'>
                    <tr>
                        <td>
                            <b> " . $item['moyenneÉvaluation'] . " </b>
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
                            <b> " . $item['moyenneÉvaluation'] . " </b>
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
    }
    $table .= ' </table></div>';
    echo $table;
} else {
    echo "T'as rien à faire icitte";
}

<?php
$username = strtoupper($_SESSION["userName"]); //en majuscule
?>

<h1 style="text-align: center;">
    PANIER DE <?php echo $username; ?>
</h1>

<hr>

<br>
<?php
//afficher l'error si y'en a une
if (isset($_GET['ErrorMSG'])) {
    $msg_error = $_GET['ErrorMSG'];
    echo "<div class='pt-3 text-danger'>
        <h5>$msg_error</h5>
    </div>";
}

//si un article est voulue ajouter au panier
if (isset($_GET['id']) || !empty($_GET['id'])) {
    $id = $_GET['id'];

    $TDG = itemTDG::getInstance();
    $res = $TDG->get_all_info_by_id($id);
    $table = "<div class='container'>
    <table>";

    foreach ($res as $column => $item) {
        $idItem = $item['idItem'];
        $table .= '<tr><td id="data"><a href="' . $item['photoItem'] . '"><img class="imageItem" src="' . $item['photoItem'] . '"></a></td>';
        $table .= '<td><ul>';
        $table .= '<li><b>Nom : </b>' . $item['nomItem'] . '</li>';
        $table .= '<li><b>Quantite en stock : </b>' . $item['quantiteStockItems'] . '</li>';
        $table .= '<li><b>Type : </b>' .  $item['typeItem'] . ' </li>';
        $table .= '<li><b>Prix : </b>' . $item['prixItem'] . '</li>';
        $table .= "</ul></td>";
        $table .= "
        <td style='border:1 px inset black;paddin:10px;'> 
            <div class='container'>
            <form class='form-signin' method='POST' action='../user.dom/addpanier.dom.php?idItem=" . $id . "'>
                <input type='number' name='Quantite' class='form-control' placeholder='Quantite' required autofocus>
                <br>
                <h4>AJOUTER CET ITEM DANS VOTRE PANIER ?</h4>
                <button type='submit'>OUI</a></button>
            </form>
            <br>
            <button><a href='../user/billboard.php'>NON</a></button>
            </div>
        <td>";
    }

    $table .= '</tr></table></div>';
    echo $table;
}
?>

<br><br>

<div class="container">
    <h4>Article dans votre panier présentement</h4>

    <div style="border-style: inset;">
        <?php
        $idJoueur = $_SESSION["userID"];

        $panier = PanierTDG::getInstance();
        $itemTDG = itemTDG::getInstance();

        $items = $panier->get_all_info_by_id($idJoueur);
        $compteurItems = 0;

        $table = "<div class='container'><table id='itemTab'>";

        //si le panier est vide
        if (empty($items)) {
            $table .= "<tr><th>Aucun article présentement :(</th></tr>";
        } 
        //si le panier contient un item
        else if(isset($items)){

            foreach ($items as $idItem) {
                $id = $idItem['idItem'];
                $res = $itemTDG->get_all_info_by_id($id);
                $quantite = $panier->get_quantite_by_idItem($id);
                $quantite = ($quantite['Quantite']);

                foreach ($res as $column => $item) {
                    $idItem = $item['idItem'];
                    $table .= "<tr><td>";
                    $table .= '<a href="' . $item['photoItem'] . '"><img class="imageItem" src="' . $item['photoItem'] . '"></a></td>';
                    $table .= '<td>' . $item['nomItem'] . '</td>';
                    $table .= "<td>$quantite</td>";

                    $table .= "
                    <td>
                        <form class='form-signin' method='POST' action='../user.dom/updatequantitepanier.dom.php?idItem=$idItem'>
                            <input type='number' name='Quantite' class='form-control' required>
                            <button type='submit'>Changer</a></button>
                        </form>
                    </td>";


                    $prixItem = $item['prixItem'];
                    $total = $prixItem * $quantite;

                    $table .= '<td style="color:green;">' . $total . '</td>';
                    
                    
                    $table .= "<td><a href='../user.dom/addinventaire.dom.php?idItem=$idItem&&Quantite=$quantite'><h5>ACHETER</h5> </a></td>";
                    $table .= "<td><h5>|</h5> </td>";
                    $table .= "<td><a href='../user.dom/deletepanier.dom.php?idItem=$idItem'><h5>SUPPRIMER</h5></a></td>";
                    $table .= '</tr>';

                    $compteurItems++;
                }
            }

        }
        $_SESSION["nbrItemsPanier"] = $compteurItems;
        $table .= ' </table></div>';
        echo $table;
        ?>
    </div>

    <a href="../user/billboard.php">Retourner à la liste</a>
</div>
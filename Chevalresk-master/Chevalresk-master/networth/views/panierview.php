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
        $quantite = $item['quantiteStockItems'];
        $table .= '
            <tr>
                <td style="left:10px;">
                    <a href="' . $item['photoItem'] . '">
                        <img class="imageItem" src="' . $item['photoItem'] . '">
                    </a>
                </td>
                <td>
                    <ul>
                        <b>' . $item['nomItem'] . '</b><br><br>
                        <a>Quantite en stock : </a><b>' . $quantite . '</b><br><br>
                        <b style="color:green;">' . $item['prixItem'] . '$</b><br>
                    </ul>
                </td>
            </tr>';
        
    $table .= "
        <tr>
            <td style='border:1 px solid black;padding:10px;text-align:center;'> 
                <div>
                    <form method='POST' action='../user.dom/addpanier.dom.php?idItem=" . $id . "'>
                        <h4 style='text-align: center; color:#555;'>AJOUTER CET ITEM DANS VOTRE PANIER ?</h4>
                        <div class='form-group'>
                            <input style='width: 100px;'min=1 max=$quantite type='number' name='Quantite' placeholder='Quantite' required autofocus>
                            <button class='btn btn-success' type='submit'>Ajouter</a></button>
                        </div>
                    </form>
                    <br>
                </div>
            <td>
        </tr>";
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
                $quantiteStock = $res[0]['quantiteStockItems'];

                foreach ($res as $column => $item) {
                    $idItem = $item['idItem'];
                    $prixItem = $item['prixItem'];
                    $total = $prixItem * $quantite;

                    $table .= "<tr>
                    <td>
                        <a href='../user.dom/deletepanier.dom.php?idItem=$idItem'>
                            <button type='button' class='btn btn-danger btn-sm'>
                                <i class='trash icon'></i>
                            </button>
                        </a>
                    </td>";

                    $table .= '
                    <td id="data">
                    <ul>
                        <a><h4>' . $item['nomItem']. "</h4></a>
                        <br><br>
                        <a><b>Qt en stock:</b>$quantiteStock</a>
                        <br>
                        <a><b>Qt voulue :</b>$quantite</a>
                        <br><br>
                        <b style='color:green;'>$total $</b>
                        <br><br>
                        <form class='form-signin' method='POST' action='../user.dom/updatequantitepanier.dom.php?idItem=$idItem'>
                            <input min=1 max=$quantiteStock type='number' name='Quantite' class='form-control' placeholder='Quantite voulue' autofocus required>
                            <br><br>
                            <button type='submit' class='ui positive button'>Changer</button>
                        </form>
                    <ul>
                    </td>";

                    $table .= '<td>
                    <a href="../user/details?id='. $idItem .'">
                        <img class="imageItem" src="' . $item['photoItem'] . '">
                    </a>
                    </td>';
                    
                    $table .= "<td>
                        <a href='../user.dom/addinventaire.dom.php?idItem=$idItem&&Quantite=$quantite'>
                            <button class='btn btn-primary'>ACHETER</button>
                        </a>
                        </td>";
                    $table .= '</tr>';

                }
            }

        }
        $table .= ' </table></div>';
        echo $table;
        ?>
    </div>

    <a href="../user/billboard.php">Retourner à la liste</a>
</div>
<?php
//afficher l'error si y'en a une
if (isset($_GET['ErrorMSG'])) {
    $msg_error = $_GET['ErrorMSG'];
    echo "<div class='pt-3 text-danger'>
        <h5>$msg_error</h5>
    </div>";
}

if (isset($_SESSION['isAdmin']))
    $isAdmin = $_SESSION['isAdmin'];
else
    $isAdmin = 0;

if(isset($_GET['alias']))
    $alias = $_GET['alias'];
else
    $alias = $_SESSION['userName'];
?>

<div class="container">
    <div style="border-style: inset;">
        <?php

        /*variables*/
        $nbrItemsInventaire = 0;
        $table = "<div class='container'><table id='itemTab'>";

        if ($isAdmin) {
            
            $inventaire = InventaireTDG::getInstance();
            $itemTDG = itemTDG::getInstance();
            $items = $inventaire->get_all_info_by_alias($alias);

        } else /*si ce n'est pas l'admin */ {
            
            $idJoueur = $_SESSION["userID"];
            $alias = $_SESSION['userName'];

            $inventaire = InventaireTDG::getInstance();
            $itemTDG = itemTDG::getInstance();
            $items = $inventaire->get_all_info_by_id($idJoueur);
        }

        //si l'inventaire est vide
        if (empty($items)) {
            $table .= "<tr><th>Aucun article présentement :(</th></tr>";
        }
        //si l'inventaire contient un item
        else if (isset($items)) {
            echo (" <h4>Présentement dans l'inventaire de $alias</h4><hr></hr>");
            $table .= "
                    <tr style='text-align:center;'>
                    <th>Nom</th>
                    <th>Quantite en stock</th>
                    <th>Quantite voulue</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Image</th>
                    <th></th></tr>
                ";

            foreach ($items as $idItem) {
                $id = $idItem['idItem'];
                $res = $itemTDG->get_all_info_by_id($id);
                $quantite = $inventaire->get_quantite_by_idItem($id);
                $quantite = ($quantite['Quantite']);

                /* Évaluations */
                $évalTDG = EvaluationTDG::getInstance();
                $evaluations = $évalTDG->get_all_info_by_idItem($id);

                foreach ($res as $column => $item) {
                    $idItem = $item['idItem'];
                    $table .= "<tr>";
                    $table .= '<td id="data">' . $item['nomItem'] . '</td>';
                    $table .= '<td id="data">' . $item['quantiteStockItems'] . '</td>';
                    $table .= "<td style='color:red;' id='data'>$quantite</td>";
                    $table .= '<td id="data">' .  $item['typeItem'] . ' </td>';
                    $table .= '<td id="data">' . $item['prixItem'] . '</td>';

                    $table .= '
                        <td id="data">
                            <a href="' . $item['photoItem'] . '">
                            <img class="imageItem" src="' . $item['photoItem'] . '">
                            </a>
                        </td>';

                    $table .= "
                        <td id='data'>
                            <button type='button' class='btn btn-danger btn-sm'>
                                <a style='color:white' href='../user.dom/deleteinventaire.dom.php?idItem=$idItem'>
                                    <span class='glyphicon glyphicon-remove'></span> Remove
                                </a>
                            </button>
                        </td>";

                    /*ajouter une évaluation*/
                    $table .= '
                        <td style="border:2px solid green;">
                            <table>
                            <form method="POST" action="../user.dom/addEvalutations.dom.php?idItem=' . $idItem . '">
                            <tr>
                                <td id="data">
                                    <h4>Ajouter un commentaire</h4>
                                    <input type="text" name="commentaire" placeholder="Commentez ici..." required autofocus>
                                </td>
                            </tr>
                            <tr>
                                <td id="data">
                                    <h4>Rating</h4>
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5" required autofocus/>
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4" required autofocus/>
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3" required autofocus/>
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2" required autofocus/>
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1" required autofocus/>
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </td>
                                <td id="data">
                                    <input class="" value="Évaluez" type="submit" name="submitRating">
                                </td>
                            </tr>
                            </table>
                            </form>
                        </td>';

                    $table .= '</tr>';
                    $nbrItemsInventaire++;
                }
            }
        }

        if (isset($_SESSION["nbrItemsInventaire"]))
            $_SESSION["nbrItemsInventaire"] = $nbrItemsInventaire;
        $table .= ' </table></div>';

        echo $table;
        ?>
    </div>
    <br>
    <a href="../user/billboard.php">Retourner à la liste</a>
</div>
</hr>
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
            echo (" <h4>Présentement dans l'inventaire de $alias</h4><hr>");

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
                    $table .= "<tr style='border:1px solid grey;'>";
                    $table .= "
                        <td id='data'>
                            <a style='color:white' href='../user.dom/deleteinventaire.dom.php?idItem=$idItem'>
                                <button type='button' class='btn btn-danger btn-sm'>
                                    <i class='trash icon'></i>
                                </button>
                            </a>
                        </td>";

                    $table .= '
                        <td id="data">
                            <a href="../user/details?id='. $idItem .'">
                                <img class="imageItem" src="' . $item['photoItem'] . '">
                            </a>
                        </td>';
                        
                    $table .= '<td id="data"><b>' . $item['nomItem'] . '</b></td>';
                    $table .= '<td id="data"><b style="color:green;">' . $item['prixItem'] . '$</b></td>';

                    /*ajouter une évaluation*/
                    $table .= '
                        <td style="background-color:white;text-align:justify;padding-top:20px;">
                            <table class="container">
                            <form method="POST" action="../user.dom/addEvalutations.dom.php?idItem=' . $idItem . '">
                            <tr>
                                <td style="bottom-margin:5px;">
                                    <h4>Ajouter un commentaire</h4>
                                    <textarea cols="20px" rows="5px" name="commentaire" placeholder="Commentez ici..." required autofocus></textarea>
                                    <h4>Ajouter une évaluation</h4>
                                        <div class="rateyo" id= "rating"
                                        data-rateyo-rating="0"
                                        data-rateyo-num-stars="5"
                                        data-rateyo-score="3"
                                        data-rateyo-full-star="true">
                                        </div>
                                    <input type="hidden" name="rating">
                                </td>
                            </tr>
                            <tr>
                                <td id="data">
                                    <input class="btn btn-success" value="Évaluer" type="submit" name="submitRating">
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
<?php
/*get l'id dans l'url */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: ../user/billboard.php");
    die();
}

/* Évaluations */
$évalTDG = EvaluationTDG::getInstance();
$evaluations = $évalTDG->get_all_info_by_idItem($id);

/*Item*/
$itemTDG = itemTDG::getInstance();
$res = $itemTDG->get_all_info_by_id($id);

/*Joueur*/
$joueurTDG = JoueurTDG::getInstance();

/*si l'item existe pas */
if (!isset($res[0]['nomItem'])) {
    header("Location: ../user/billboard.php");
    die();
}
$photoItem = $res[0]['photoItem'];
$nomITem = $res[0]['nomItem'];
$moyenne = $res[0]['moyenneÉvaluation'];

$tableDétails = "<div class='container'><table class='container' id='itemTab'>";

/*variables*/
$uneÉtoile = 0;
$deuxÉtoiles = 0;
$troisÉtoiles = 0;
$quatreÉtoiles = 0;
$cinqÉtoiles = 0;

$one_eval = 0;
$two_eval = 0;
$three_eval = 0;
$four_eval = 0;
$five_eval = 0;

$etoiles = 0;

$nbrÉvalutaions = 0;
?>

<h3 style="text-align: center; color:#555;">Détails sur <?php echo ($nomITem) ?></h3>

<?PHP
foreach ($res as $column => $item) {
    $idItem = $item['idItem'];
    $quantite = $item['quantiteStockItems'];

    $tableDétails .= '
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
    </td>';

    $tableDétails .= "
    <tr>
        <td style='border:1 px solid black;padding:10px;'> 
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
    $tableDétails .= "</table></div>";

    $tableCommentaire = "<div class='container'><table class='container' id='itemTab'>";
    $tableCommentaire .= "<tr><td class='intro'><h2>Évaluations</h2></td></tr>";

    /* Display les commentaires */
    foreach ($evaluations as $commetnaire => $e) {

        $res = $joueurTDG->get_all_info_by_id($e['idJoueur']);

        $idEvaluation = $evaluations[0]['idEvaluation'];

        if (isset($res[0]['urlPhotoProfil']))
            $url = $res[0]['urlPhotoProfil'];
        else
            $url = '../img/no_profile_pic.png';

        if (isset($res[0]['alias']))
            $alias = $res[0]['alias'];
        else
            $alias = "Stranger";

        $etoiles = $e['NbrÉtoile'];
        $nbrÉvalutaions++;

        if ($etoiles == 1)
            $uneÉtoile++;

        if ($etoiles == 2)
            $deuxÉtoiles++;

        if ($etoiles == 3)
            $troisÉtoiles++;

        else if ($etoiles == 4)
            $quatreÉtoiles++;

        else if ($etoiles == 5)
            $cinqÉtoiles++;

        $tableCommentaire .= " 
            <tr class='intro'>
                <td style='background-color:white;text-align:justify;'>
                    <img class='rounded-circle' style='width:30px;height:30px;'src='" . $url . "'>
                    <b>" . $res[0]['alias'] . "</b><br>
                    <span> Commentaire : " . $e['Commentaire'] . " </span><br>
                    <span> Evaluation : <div class='rateyo' id= 'rating'
                    data-rateyo-rating='" . $e['NbrÉtoile'] . "'
                    data-rateyo-read-only='true'>
                    </div></span><br>";


        if ($_SESSION['isAdmin'] == 1 || $_SESSION['userID'] == $res[0]['idJoueur']) {
            $tableCommentaire .= "
            <a style='color:white' href='../user.dom/deleteEvaluations.dom.php?idEvaluation=$idEvaluation'>
                <button type='button' class='btn btn-danger btn-sm'>
                    <i class='trash icon'></i>
                </button>
            </a>";
        }

        $tableCommentaire .= "</td>";
    }
    $one_eval = round((($uneÉtoile / $nbrÉvalutaions) * 100), 2);
    $two_eval = round((($deuxÉtoiles / $nbrÉvalutaions) * 100), 2);
    $three_eval = round((($troisÉtoiles / $nbrÉvalutaions) * 100), 2);
    $four_eval = round((($quatreÉtoiles / $nbrÉvalutaions) * 100), 2);
    $five_eval = round((($cinqÉtoiles / $nbrÉvalutaions) * 100), 2);

    $moyenne = round(((($uneÉtoile * 1) + ($deuxÉtoiles * 2) + ($troisÉtoiles * 3) + ($quatreÉtoiles * 4) + ($cinqÉtoiles * 5)) / $nbrÉvalutaions), 2);
    $itemTDG->update_moyenne_évaluation_by_id($idItem, $moyenne);
}


/*--table pour les Évaluations-- */
$tableCommentaire .= "</table>";
$tableÉvaluations = "<div class='container'><table style='background-color:white;' class='container' id='itemTab'>";
$tableÉvaluations .= "<tr><td class='intro'><h2>Appréciations de $nomITem | $moyenne ✰</h2></td></tr>";

if ($etoiles > 0) {
    $tableÉvaluations .= "
        <tr class='container'>
            <td><h3>" . $nbrÉvalutaions . " évaluations au total</h3></td>
        </tr>
        <tr class='container'>
            <td>" . $one_eval . "% des personnes ont donné 1 étoiles ($uneÉtoile personnes)</td>
        </tr>
        <tr class='container'>
            <td>" . $two_eval . "% des personnes ont donné 2 étoiles ($deuxÉtoiles personnes)</td>
        </tr>
        <tr class='container'>
            <td>" . $three_eval . "% des personnes ont donné 3 étoiles ($troisÉtoiles personnes)</td>
        </tr>
        <tr class='container'>
            <td>" . $four_eval . "% des personnes ont donné 4 étoiles ($quatreÉtoiles personnes )</td>
        </tr>
        <tr class='container'>
            <td>" . $five_eval . "% des personnes ont donné 5 étoiles ($cinqÉtoiles personnes)</td>
        </tr>
        ";
} else if ($etoiles <= 0) {
    $tableÉvaluations .= "
    <tr class='container'>
        <td>Aucune évaluations :(</td>
    </tr>";
}

$tableÉvaluations .= "</table></div>";
/*--Display les tables-- */
echo $tableDétails;
echo $tableCommentaire;
echo $tableÉvaluations;
?>
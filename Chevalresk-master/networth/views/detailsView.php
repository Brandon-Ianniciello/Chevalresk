<?php
/*get l'id dans l'url */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else
    $id = null;

if (isset($_GET['idJoueur'])) {
    $idJoueur = $_GET['idJoueur'];
} else {
    $idJoueur = null;
}


/* Évaluations */
$évalTDG = EvaluationTDG::getInstance();
$evaluations = $évalTDG->get_all_info_by_idItem($id);

/*Item*/
$itemTDG = itemTDG::getInstance();
$res = $itemTDG->get_all_info_by_id($id);

/*Joueur*/
$joueurTDG = JoueurTDG::getInstance();

$photoItem = $res[0]['photoItem'];
$nomITem = $res[0]['nomItem'];

$table = "<div class='container'><table id='itemTab'>";

?>

<h3 style="text-align: center; color:#555;">Détails sur <?php echo ($nomITem); ?></h3>

<?PHP
foreach ($res as $column => $item) {
    $idItem = $item['idItem'];
    $table .= '<tr class="intro"><td id="data"><a href="' . $item['photoItem'] . '"><img class="imageItem" src="' . $item['photoItem'] . '"></a></td>';
    $table .= '<td><ul>';
    $table .= '<li><b>Nom : </b>' . $item['nomItem'] . '</li>';
    $table .= '<li><b>Quantite en stock : </b>' . $item['quantiteStockItems'] . '</li>';
    $table .= '<li><b>Type : </b>' .  $item['typeItem'] . ' </li>';
    $table .= '<li><b>Prix : </b>' . $item['prixItem'] . '</li>';
    $table .= "</ul></td>";
    $table .= "
    <td style='border:1 px solid black;paddin:10px;'> 
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
    $table .= "<tr style='width:100%;'><td><h2 style='color:#555; text-align:center;'>Évaluations</h2></td></tr>";

    /* Display les commentaires */
    // if (isset($evaluations['Commentaire'])) {
    foreach ($evaluations as $commetnaire => $e) {
        $res = $joueurTDG->get_all_info_by_id($e['idJoueur']);

        if(isset($res[0]['urlPhotoProfil']))
            $url = $res[0]['urlPhotoProfil'];
        else
            $url = '../img/no_profile_pic.png';

        if(isset($res[0]['alias']))
            $alias = $res[0]['alias'];
        else
            $alias = "Stranger";

        $etoiles = $e['NbrÉtoile'];
        $table .= "
        <tr class='intro'>
            <td style='background-color:beige;'>
                <img class='rounded-circle' style='width:30px;height:30px;'src='". $url ."'>
                <b>".$res[0]['alias']." :</b><br>
                <span> Commentaire : ".$e['Commentaire']." </span><br>
                <span> Evaluation : ".$e['NbrÉtoile']."/5 </span>


            </td>
        </tr>";
    }
}

$table .= "</tr></table></tr></table></div>";
echo $table;
?>
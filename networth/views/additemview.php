<?php
$username = strtoupper($_SESSION["userName"]); //en majuscule
?>

<div class="container">
<form class="form-signin" method="POST" action="../user.dom/additem.dom.php">

    <h2 style="text-align: center;">
        AJOUT ADMINISTRATIF D'UN ITEM PAR <?php echo $username; ?>
    </h2>
    <div class="pt-3">
        <input type="text" id="nomItem" name="nomItem" class="form-control" placeholder="Nom de l'item" required autofocus>
    </div>
    <div class="pt-3">
        <input type="text" id="quantiteStockItems" name="quantiteStockItems" class="form-control" placeholder="Quantite en stock" required autofocus>
    </div>
    <div class="pt-3">
        <input type="text" id="typeItem" name="typeItem" class="form-control" placeholder="Type" required autofocus>
    </div>
    <div class="pt-3">
        <input type="text" id="prixItem" name="prixItem" class="form-control" placeholder="Prix" required autofocus>
    </div>
    <div class="pt-3">
        <input type="url" id="photoItem" name="photoItem" class="form-control" placeholder="URL : Photo de l'item" required autofocus>
    </div>
    <button class="btn btn-lg btn btn-dark btn-block mt-3" type="submit">AJOUTER</button>
</form>
</div>
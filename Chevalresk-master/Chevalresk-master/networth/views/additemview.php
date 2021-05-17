<?php
$username = strtoupper($_SESSION["userName"]); //en majuscule
?>

<div class="container">
    <form class="form-signin" method="POST" action="../user.dom/additem.dom.php" id="FormulaireAddItem">

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
            <div class="ui form">
                <div class="grouped fields">
                    <h3>Type d'item:</h3>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="typeItem" id="Arme" value="A">
                            <label for="Arme" style="cursor:pointer;">Arme</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="typeItem" id="Armure" value="M">
                            <label for="Armure" style="cursor:pointer;">Armure</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="typeItem" id="Potion" value="P">
                            <label for="Potion" style="cursor:pointer;">Potion</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="typeItem" id="Ressource" value="R">
                            <label for="Ressource" style="cursor:pointer;">Ressources</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-3">
            <div id="formType" class="ui form">

            </div>
        </div>
        <div class="pt-3">
            <input type="number" id="prixItem" name="prixItem" class="form-control" placeholder="Prix" required autofocus>
        </div>
        <div class="pt-3">
            <input type="url" id="photoItem" name="photoItem" class="form-control" placeholder="URL : Photo de l'item" required autofocus>
        </div>
        <button class="btn btn-lg btn btn-dark btn-block mt-3" type="submit">AJOUTER</button>
    </form>
</div>

<script type="text/javascript">
    let form = document.getElementById("formType")

    $("#Arme").on('click', () => {
        form.innerHTML = ("<div class='field'><input type='number' name='efficaciteArme' min=1 max=10 placeholder='Efficacite' required autofocus></div>")
        form.insertAdjacentHTML("afterbegin","<div class='field'><input type='text' name='genreArme'placeholder='Genre (quels mains ?)' required autofocus></div>")
        form.insertAdjacentHTML("beforeend","<div class='field'><textarea cols='20px' rows='5px' name='descriptionArme' placeholder='Description ...' required autofocus></textarea></div>")
    })

    $("#Armure").on('click', () => {
        form.innerHTML = ("<div class='field'><input type='number' name='poidArmure' placeholder='Poids en livre...'></div>")
        form.insertAdjacentHTML("afterbegin", "<div class='field'><input type='number' name='tailleArmure'placeholder='Taille en cm...'></div>")
        form.insertAdjacentHTML("afterbegin", "<div class='field'><input type='text' name='matièreArmure' placeholder='Matière' required autofocus></div>")
    })

    $("#Potion").on('click', () => {
        form.innerHTML = ("<div class='field'><input type='number' name='duréePotion' placeholder='Durée en secondes'></div>")
        form.insertAdjacentHTML("beforeend", "<div class='field'><textarea cols='20px' rows='5px' name='effetPotion' placeholder='Décrivez le effet de la potion ...' required autofocus></textarea></div>")
    })

    $("#Ressource").on('click',() => {
        form.innerHTML = ("<div class='field'><textarea cols='20px' rows='5px' name='descriptionRessource' placeholder='Description ...' required autofocus></textarea></div>")
    })
</script>
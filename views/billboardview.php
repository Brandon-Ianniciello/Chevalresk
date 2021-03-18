<div class="container">
    <h1 style="text-align: center;">ITEMS</h1>
</div>
<br>
<?php
$buyable = false;
if (validate_session()) {
    $buyable = true;
}
?>

<div class="container">
    <table id="itemTab">
        <tr>
            <td>
                
                <img class="modele" src="../img/ARMURE.jpg" alt="">
                <h3 style="text-align: center;">Armure de chevalier</h3>
            </td>
            <td>
                <img class="modele" src="../img/POTIONS.jpg" alt="">
                <h3 style="text-align: center;">Potions</h3>

            </td>
            <td>
                <img class="modele" src="../img/ÉPÉE.jpg" alt="">
                <h3 style="text-align: center;">Épée de fer</h3>
            </td>
        </tr>

    </table> 
</div>
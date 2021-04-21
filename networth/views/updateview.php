<?php
$username = $_SESSION["userName"];
$email = $_SESSION["userEmail"];
$id = $_SESSION["userID"];
$profileImg = $_SESSION["userProfileImage"];

if(isset($_SESSION["userSolde"]))
    $solde = $_SESSION["userSolde"];

//afficher l'error si y'en a une
if (isset($_GET['ErrorMSG'])) {
    $msg_error = $_GET['ErrorMSG'];
    echo "<div class='pt-3 text-danger'>
        <h5>$msg_error</h5>
    </div>";
}
?>

<div class="container">
    <table>
        <th>
            INFORMATIONS UTILISATEURS DE <?PHP echo(strtoupper($username)) ?>
        </th>
        <tr>
            <td>
                <a class="cellule">Alias : <?php echo $username ?></a>
            </td>
        </tr>
        <tr>
            <td>
                <a class="cellule">Courriel : <?php echo $email ?></a>
            </td>
        </tr>
       
        <tr>
            <td>
                <a class="cellule">Solde de l'utilisateur : <?php echo $solde ?></a>
            </td>
        </tr>
    </table>
</div>
<br><br>
<div>
    <table class="container">
        <hr>
        <tr>
            <td>
                <h4>ALIAS</h4>
                <form action="../user.dom/updateusername.dom.php" method="POST">
                    <input type="text" name="Nusername" placeholder="Nouvel alias" required autofocus>
                    <button type="submit" class="btn btn-dark">CHANGER</button>
                </form>
            </td>
            <td>
                <h4>COURRIEL</h4>
                <form action="../user.dom/updateemail.dom.php" method="POST">
                    <input type="email" name="Nemail" placeholder="Courriel" id='Nemail' required autofocus>
                    <button type="submit" name="emailButton" class="btn btn-dark">CHANGER</button>
                </form>
            </td>
        </tr>
        </hr>
        <tr>
            <td>
                <h4>MOT DE PASSE</h4>
                <form action="../user.dom/updatepw.dom.php" method="POST">
                    <ul class="container">
                    
                        <input type="password" name="oldpw" placeholder="Mot de passe" required autofocus></li>
                    
                        <input type="password" name="newpw" placeholder="Nouveau mot de passe" required autofocus>
                    
                        <input type="password" name="pwValidation" placeholder="Confirmation" required autofocus>
                    
                        <button type="submit" name="usernameButton" class="btn btn-dark">CHANGER</button>
                    </ul>
                </form>
            </td>
        </tr>

        <tr>
            <td>
                <h3>Changer la photo de profile de <?PHP echo $username ?></h3>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Photo actuelle</h4>
                <img style="width: 400px;height:300px;" src="<?php echo $profileImg;?>">
            </td>

            <td>
                <form action="../user.dom/updateprofileimg.dom.php" method="POST">
                    <h4>Changer la photo de profil</h4>
                    <input type="url" style="width:300px;" required name="Nphoto">
                    <button type="submit" name="photoButton" class="btn btn-dark">CHANGER</button>
                </form>
            </td>
        </tr>
    </table>
</div>
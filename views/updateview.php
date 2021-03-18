<?php
$username = $_SESSION["userName"];
$email = $_SESSION["userEmail"];
$id = $_SESSION["userID"];
?>

<div class="container">
    <table>
        <th>
            INFORMATION UTILSATEURS
        </th>
        <tr>
            <td>
                <a class="cellule">Username : <?php echo $username ?></a>
            </td>
        </tr>
        <tr>
            <td>
                <a class="cellule">Email : <?php echo $email ?></a>
            </td>
        </tr>
        <tr>
            <td>
                <a class="cellule">id de l'utilisateur : <?php echo $id ?></a>
            </td>
        </tr>
    </table>
</div>
<br><br>
<div class="container">
    <table>
        <tr>
            <td>
                <h3>Update <?PHP echo $username ?> informations</h3>
            </td>
        </tr>
        <tr>
            <td>
                <form action="../user.dom/updateusername.dom.php">
                    <label for="Username">Username</label>
                    <input type="text" name="Nusername" required>
                    <button type="submit" class="btn btn-lg btn btn-dark btn-block mt-3">CHANGE</button>
                </form>
            </td>

            <td>
                <form action="../user.dom/updateemail.dom.php">
                    <label for="Email">Email</label>
                    <input type="text" name="Nemail" required>
                    <button type="submit" name="emailButton" class="btn btn-lg btn btn-dark btn-block mt-3">CHANGE</button>
                </form>
            </td>

            <td>
                <form action="../user.dom/updatepw.dom.php">
                    <label for="Password">Password</label>
                    <input type="text" name="Nusername" required>
                    <button type="submit" name="usernameButton" class="btn btn-lg btn btn-dark btn-block mt-3">CHANGE</button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <br><br>

                <h3>Update <?PHP echo $username ?> profile's picture</h3>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Present picture</h4>
                <img src="../img/temp.jpg">

            </td>

            <td>
                <form action="">
                    <h4>New profile picture</h4>
                    <input type="file" required name="Nphoto">
                    <button type="submit" name="photoButton" class="btn btn-lg btn btn-dark btn-block mt-3">CHANGE</button>
                </form>
            </td>
        </tr>
    </table>
</div>
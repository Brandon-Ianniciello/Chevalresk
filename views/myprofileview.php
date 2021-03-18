<?php
$username = $_SESSION["userName"];
$email = $_SESSION["userEmail"];
$id = $_SESSION["userID"];
?>

<div class="container" style="margin-top:30px">
  <h1>
    <?php
    echo $username
    ?>
    <img class="rounded-circle" src="../img/temp.jpg">
  </h1>

  <!--Modifier le profil-->
  <A href="../user/update.php" style="color: black;font-size:xx-large">UPDATE YOUR PROFILE</A>

  <div class="tab_info">
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
          <a class="cellule">ID de l'utilisateur : <?php echo $id ?></a>
        </td>
      </tr>
    </table>
  </div>

</div>
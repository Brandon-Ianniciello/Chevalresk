<?php
$username = $_SESSION["userName"];
$email = $_SESSION["userEmail"];
$id = $_SESSION["userID"];
$profileImg = $_SESSION["userProfileImage"];
$solde = $_SESSION["userSolde"];
?>

<div class="container" style="margin-top:30px">
  <h1>
    <?php
    echo $username
    ?>
    <img class="rounded-circle" style="width: 200px;height:200px;" src='<?php echo $profileImg; ?>'>
  </h1>

  <!--Modifier le profil-->
  <A href="../user/update.php" style="color: black;font-size:xx-large">UPDATE YOUR PROFILE</A>
  <?php
  if (isset($_GET['ErrorMSG'])) {
    $msg_error = $_GET['ErrorMSG'];
    echo "<div class='pt-3 text-danger'>
      <h5><p>$msg_error</p></h5>
  </div>";
  }
  ?>
  <div class="tab_info">
    <table>
      <th>
        INFORMATIONS UTILISATEURS
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
          <a class="cellule">Solde de l'utilisateur : <?php echo $solde ?></a>
        </td>
      </tr>
    </table>
  </div>

</div>
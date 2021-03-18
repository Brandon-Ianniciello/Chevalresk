<table>
    <tr class="container">
        <td>
            <!--Diaporama-->
            <div class="Diaporama">
                <div class="slides">

                    <div class="slide">
                        <p></p>
                    </div>

                    <div class="slide">
                        <p></p>
                    </div>

                    <div class="slide">
                        <p></p>
                    </div>

                    <div class="slide">
                        <p></p>
                    </div>
                    <div class="slide">
                        <p></p>
                    </div>

                    <div class="slide">
                        <p></p>
                    </div>
                </div>
            </div>
        </td>

        <td style="position: relative;left:300px;bottom:50px;">
            <form class="form-signin" method="POST" action="../user.dom/register.dom.php">

                <h2 style="text-align:center;">Register</h2>

                <?php
                if (isset($_GET['errmsg'])) {
                    $msg_error = $_GET['errmsg'];
                    echo "<div class='pt-3 text-danger'>
                    <h5>$msg_error</h5>
                </div>";
                }
                ?>

                <div class="pt-3">
                    <label for="alias" class="sr-only">Alias</label>
                    <input type="text" id="alias" name="alias" class="form-control" placeholder="Alias" required autofocus>
                </div>

                <div class="pt-3">
                    <label for="nom" class="sr-only">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" required autofocus>
                </div>

                <div class="pt-3">
                    <label for="alias" class="sr-only">Prénom</label>
                    <input type="text" id="prénom" name="prénom" class="form-control" placeholder="Prénom" required autofocus>
                </div>

                <div class="pt-3">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
                </div>

                <div class="pt-3">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="pt-3">
                    <label for="confirmpassword" class="sr-only">Confirm password</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm password" required>
                </div>

                <button class="btn btn-lg btn btn-dark btn-block mt-3" type="submit">Register</button>

            </form>

            <a style="text-align: center;" href="../user/login.php">Already have an account ?</a>
        </td>
    </tr>
</table>
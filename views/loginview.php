<table>
    <tr>
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

        <td style="position: relative;left:300px;bottom:100px;">
            <div>
                <form class="form-signin" method="POST" action="../user.dom/login.dom.php">

                    <h2 style="text-align: center;">Login</h2>

                    <?php
                    if (isset($_GET['errmsg'])) {
                        echo '<div class="pt-3 text-danger">
                        <h5>Invalid credentials</h5>
                    </div>';
                    }
                    ?>

                    <div class="pt-3">
                        <label for="username" class="sr-only">Username</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
                    </div>

                    <div class="pt-3">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    </div>


                    <button class="btn btn-lg btn btn-dark btn-block mt-3" type="submit">Sign in</button>

                </form>
            </div>

            <a style="text-align: center;" href="../user/register.php">You don't have an account ? Click here.</a>
        </td>
    </tr>
</table>
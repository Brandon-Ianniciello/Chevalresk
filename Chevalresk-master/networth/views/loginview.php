<body class="bodyLogin">
    <div class="center">
        <h1>Se connecter</h1>
        <form method="POST" action="../user.dom/login.dom.php">


            <?php
            if (isset($_GET['errmsg'])) {
                echo '<div class="pt-3 text-danger">
                        <h5>Invalid credentials</h5>
                    </div>';
            }
            ?>

            <div class="txt_field">
                <input type="email" id="email" name="email" required autofocus>
                <span></span>
                <label>Courriel</label>
            </div>

            <div class="txt_field">
                <input type="password" id="password" name="password" required>
                <span></span>
                <label>Mot de passe</label>
            </div>
            <input type="submit" value="Connecter" class='login-btn'>
            <div class="Signup_link">Vous n'êtes pas un membre? <a href="../user/register.php">Inscrivez-vous!</a></div>

        </form>
    </div>
</body>
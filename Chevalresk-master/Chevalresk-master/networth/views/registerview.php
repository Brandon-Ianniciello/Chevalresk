    <div class="center">
        <h1>S'enregistrer</h1>
        <form method="POST" action="../user.dom/register.dom.php">
            <?php
            if (isset($_GET['errmsg'])) {
                $msg_error = $_GET['errmsg'];
                echo "<div class='pt-3 text-danger'>
                    <h5><p>$msg_error</p></h5>
                </div>";
            }
            ?>

            <?php
                if(isset($_GET['email'])){
                    $email = $_GET['email'];
                    echo 
                    '<div class="txt_field">
                        <input type="email" id="email" name="email" required value='.$email.'>
                        <span></span>
                        <label>Email</label>
                    </div>';    
                }else{
                    echo 
                    '<div class="txt_field">
                        <input type="email" id="email" name="email" required>
                        <span></span>
                        <label>Email</label>
                    </div>';
                }

            ?>

            <?php
                if(isset($_GET['alias'])){
                    $alias = $_GET['alias'];
                    echo 
                    '<div class="txt_field">
                        <input type="text" id="alias" name="alias" required value='.$alias.'>
                        <span></span>
                        <label>Alias</label>     
                    </div>';    
                }else{
                    echo 
                    '<div class="txt_field">
                        <input type="text" id="alias" name="alias" required>
                        <span></span>
                        <label>Alias</label>
                    </div>';
                }

            ?>

            <?php
                if(isset($_GET['nom'])){
                    $nom = $_GET['nom'];
                    echo 
                    '<div class="txt_field">
                        <input type="text" id="nom" name="nom" required value='.$nom.'>
                        <span></span>
                        <label>Nom</label>       
                    </div>';    
                }else{
                    echo 
                    '<div class="txt_field">
                        <input type="text" id="nom" name="nom" required>
                        <span></span>
                        <label>Nom</label>
                    </div>';
                }

            ?>

            <?php
                if(isset($_GET['prenom'])){
                    $prenom = $_GET['prenom'];
                    echo 
                    '<div class="txt_field">
                        <input type="text" id="prenom" name="prenom" required value='.$prenom.'>
                        <span></span>
                        <label>Prénom</label>       
                    </div>';    
                }else{
                    echo 
                    '<div class="txt_field">
                        <input type="text" id="prenom" name="prenom" required>
                        <span></span>
                        <label>Prénom</label>
                    </div>';
                }

            ?>

            <div class="txt_field">
                <input type="password" id="password" name="password" required>
                <span></span>
                <label>Mot de passe</label>          
            </div>

            <div class="txt_field">
                <input type="password" id="confirmpassword" name="confirmpassword" required>
                <span></span>
                <label>Confirmez mot de passe</label>
            </div>

            <input type="submit" value="S'enregistrer" class='login-btn'>
            <div class="Signup_link">Vous avez déjà un compte?<a href="../user/login.php"> Connectez-vous!</a></div>

        </form>
    </div>

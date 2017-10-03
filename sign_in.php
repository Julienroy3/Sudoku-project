<?php include('header.php'); ?>

    <div class="connect">
    
        <form class="form_connect" action="sign_in_script.php" method="post">
            
            <h2>Connexion</h2>
            
            <label for="pseudo">Pseudo ou email</label><input type="text" name="name" id="pseudo" required><br>
            <label for="mdp">Mot de passe</label><input type="password" name="mdp" id="mdp" required><br>
            
            <div class="send">
                <input type="submit" name="valid_in" value="Se connecter"><br>
            </div>
        </form>
        
        <a href="sign_up.php">S'inscrire</a>
        
    </div>
    </body>
</html>
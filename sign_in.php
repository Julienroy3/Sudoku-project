<?php require('header.php'); ?>

<!-- form sign in -->
    <div class="col-sm-12 connect">

        <form class="form_connect" action="sign_in_script.php" method="post">

            <h2 class="text-center">Connexion</h2>

            <div class="form-group">
                <label for="pseudo" class="col-sm-12 control-label">Pseudo ou email</label>
                <div class="col-sm-12">
                    <input type="text" name="name" id="pseudo" class="form-control" placeholder="Pseudo ou email" required>
                </div>
            </div>

            <div class="form-group">
            <label for="mdp" class="col-sm-12 control-label">Mot de passe</label>
                <div class="col-sm-12">
                    <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Mot de passe" required>
                </div>
            </div>

            <div class="text-center send">
                <input type="submit" name="valid_in" class="btn btn-default" value="Se connecter"><br>
            </div>
        </form>

    </div>

<?php require('footer.php'); ?>

<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sudoku</title>
    </head>

    <body>
        <p>Connexion</p>
        
        <form action="sign_in_script.php" method="post">
            Pseudo ou email : <input type="text" name="name" required><br>
            Mot de passe : <input type="password" name="mdp" required><br>
            
            <input type="submit" name="valid_in" value="Se connecter">
        </form>
        
        <a href="sign_up.php">S'inscrire</a>
    </body>
</html>
<?php

include('connect.php');
include('header.php'); 

if(isset($_POST["valid_up"])){
    
    //variables
    $username = stripslashes(htmlentities($_POST["username"]));
    $email =  stripslashes(htmlentities($_POST["email"]));
    $mdp1 = md5($_POST["mdp1"]);
    $mdp2 =  md5($_POST["mdp2"]);
    
    //verify is pseudo is already exist
    $ex = $bdd->prepare("SELECT COUNT(*) AS pseudo FROM Utilisateur WHERE username = :pseudo");
    $ex->bindParam(":pseudo", $username, PDO::PARAM_STR);
    $ex->execute();
    $pseudo = $ex->fetch();

    if($pseudo["pseudo"] == 1){
        echo "<p class='required'>Ce pseudo existe déjà ! Veuillez en choisir un autre.</p>";
    }else{
    
        //invalid password
        if($mdp1 != $mdp2){  
            echo "<p class='required'>Les mots de passes sont différents !</p>";
        }
        //invalid email
        elseif(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)){
            echo "<p style='color:red'>Veuillez entrer un email valide !</p>";
        }else{

            if($_FILES['icon']['name']){

                //replace specials characters
                function replace_accents($chaine, $charset="utf-8"){
                    $chaine = htmlentities($chaine, ENT_NOQUOTES, $charset);
                    $chaine = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $chaine);
                    $chaine = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $chaine);
                    $chaine = preg_replace('/([^.a-z0-9]+)/i', '_', $chaine);
                    return $chaine;
                }

                $folder = "icons/";
                $file = date("Y_m_d_H_i_s")."_".basename($_FILES['icon']['name']);
                $tmp_file = $_FILES['icon']['tmp_name'];
                $max_size = 10000000;
                $size = filesize($_FILES['icon']['tmp_name']);
                $valid_extension = array('.png', '.jpg', '.jpeg', '.gif'); 
                $file_extension = strtolower(strrchr($_FILES['icon']['name'], '.'));

                //version
                if(!in_array($file_extension, $valid_extension)){
                    $error = "<p class='required'>Le fichier n'est pas au bon format !</p>";
                }
                //size
                if($size > $max_size){
                    $error = "<p class='required'>Le fichier est trop lourd !</p>";
                }

                //no errors
                if(!isset($error)){

                    $file = replace_accents($file);

                    if(!is_uploaded_file($tmp_file)){
                        echo "<p class='required'>Le fichier est introuvable !</p>";
                    }

                    if(move_uploaded_file($tmp_file, $folder . $file)){
                        $file = $_FILES['icon']['name'];
                        $file = date("Y_m_d_H_i_s")."_".replace_accents($file);
                    }else{
                        echo "<p class='required'>Une erreur est survenue ! Veuillez recommencez.</p>";
                    }
                }else{
                    echo $error;
                }
            }else{
                $file = "default.png";
            }

            $rep = $bdd->prepare("INSERT INTO Utilisateur(username, email, password, icon, date_sign) VALUES (:username, :email, :password, :icon, CURDATE())");

            $rep->bindParam(":username", $username, PDO::PARAM_STR);
            $rep->bindParam(":email", $email, PDO::PARAM_STR);
            $rep->bindParam(":password", $mdp1, PDO::PARAM_STR);
            $rep->bindParam(":icon", $file, PDO::PARAM_STR);
            $rep->execute();

            echo "Vous venez de vous inscrire. Clicquez sur <a href='sign_in.php'>Se connecter</a> pour continuer.";
            
            $rep->closeCursor();
        }
        
        $ex->closeCursor();
    }
}

?>
        <div class="connect">
        
        <form class="form_connect" method="post" enctype="multipart/form-data">
            
            <h2>Inscription</h2>
            
            <label for="mail">Email<span class="required">*</span></label><input type="email" name="email" id="mail" required><br>
            <label for="pseudo">Pseudo<span class="required">*</span></label><input type="text" name="username" id="pseudo" required><br>
            <label for="mdp">Mot de passe<span class="required">*</span></label><input type="password" name="mdp1" id="mdp" required><br>
            <label for="confirm">Confimez votre mot de passe<span class="required">*</span></label><input type="password" name="mdp2" id="confirm" required><br>
            <label for="icon">Icône</label><input type="file" name="icon" id="icon" accept=".png, .jpg, .jpeg, .gif"><br>

            <div class="send">
                <input type="submit" name="valid_up" value="S'inscrire">
            </div>
        </form>
            
            <a href="sign_in.php">Se connecter</a>
            
    </div>
    
    </body>
</html>
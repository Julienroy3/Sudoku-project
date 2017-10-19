<?php

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
        echo "<p class='col-sm-12 required'>Ce pseudo existe déjà ! Veuillez en choisir un autre.</p>";
    }else{
    
        //invalid password
        if($mdp1 != $mdp2){  
            echo "<p class='col-sm-12 required'>Les mots de passes sont différents !</p>";
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
                    $error = "<p class='col-sm-12 required'>Le fichier n'est pas au bon format !</p>";
                }
                //size
                if($size > $max_size){
                    $error = "<p class='col-sm-12 required'>Le fichier est trop lourd !</p>";
                }

                //no errors
                if(!isset($error)){

                    $file = replace_accents($file);

                    if(!is_uploaded_file($tmp_file)){
                        echo "<p class='col-sm-12 required'>Le fichier est introuvable !</p>";
                    }

                    if(move_uploaded_file($tmp_file, $folder . $file)){
                        $file = $_FILES['icon']['name'];
                        $file = date("Y_m_d_H_i_s")."_".replace_accents($file);
                    }else{
                        echo "<p class='col-sm-12 required'>Une erreur est survenue ! Veuillez recommencez.</p>";
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
        <div class="col-sm-12 connect">
        
        <form class="form_connect" method="post" enctype="multipart/form-data">
            
            <h2 class="text-center">Inscription</h2>
            
            <div class="form-group">
                <label for="mail" class="col-sm-12 control-label">Email<span class="required">*</span></label>
                <div class="col-sm-12">
                    <input type="email" name="email" id="mail" class="form-control" placeholder="Email" required>
                </div>
            </div>
            <div class="form-group">
            <label for="pseudo" class="col-sm-12 control-label">Pseudo<span class="required">*</span></label>
                <div class="col-sm-12">
                    <input type="text" name="username" id="pseudo" class="form-control" placeholder="Pseudo" required>
                </div>
            </div>
                
            <div class="form-group">
            <label for="mdp" class="col-sm-12 control-label">Mot de passe<span class="required">*</span></label>
                <div class="col-sm-12">
                    <input type="password" name="mdp1" id="mdp" class="form-control" placeholder="Mot de passe" required>
                </div>
            </div>
            
            <div class="form-group">
            <label for="confirm" class="col-sm-12 control-label">Confimez votre mot de passe<span class="required">*</span></label>
                 <div class="col-sm-12">
                    <input type="password" name="mdp2" id="confirm" class="form-control" placeholder="Confirmer le mot de passe" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="icon" class="col-sm-12 control-label">Icône</label>
                <div class="col-sm-12">
                    <input type="file" name="icon" id="icon" accept=".png, .jpg, .jpeg, .gif">
                </div>
            </div>

            <div class="text-center send">
                <input type="submit" name="valid_up" class="btn btn-default" value="S'inscrire">
            </div>
        </form>

    </div>
    
<?php include('footer.php'); ?>
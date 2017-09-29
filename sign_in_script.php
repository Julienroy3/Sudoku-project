<?php

include("connect.php");

if(isset($_POST["valid_in"])){
    
    $name =  stripslashes(htmlentities($_POST["name"]));
    $mdp =  md5($_POST["mdp"]);
    
    $rep = $bdd->prepare("SELECT id FROM users WHERE password = :password AND (username = :name OR email = :name)");
    
    $rep->bindParam(":name", $name, PDO::PARAM_STR);
    $rep->bindParam(":password", $mdp, PDO::PARAM_STR);
    $rep->execute();
    
    $res = $rep->fetch();
    
    if($res){
        session_start();
        $_SESSION["id"] = $res["id"];
        $_SESSION["username"] = $res["username"];
        header("Location: profil.php");
    }else{
        echo "<p style='color:red'>Une erreur est survenue ! Veuilez recommencez. <br> <a href='sign_in.php'>Retour</a></p>";
    }
        
}



?>
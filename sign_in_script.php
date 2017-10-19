<?php

include("connect.php");
session_start(); 

if(isset($_POST["valid_in"])){
    
    $name =  stripslashes(htmlentities($_POST["name"]));
    $mdp =  md5($_POST["mdp"]);
    
    $rep = $bdd->prepare("SELECT IdUser FROM Utilisateur WHERE password = :password AND (username = :name OR email = :name)");
    
    $rep->bindParam(":name", $name, PDO::PARAM_STR);
    $rep->bindParam(":password", $mdp, PDO::PARAM_STR);
    $rep->execute();
    
    $res = $rep->fetch();
    
    if($res){
        session_start();
        $_SESSION["IdUser"] = $res["IdUser"];
        $_SESSION["username"] = $res["username"];
        header("Location: index.php");
        
    }else{
        echo "<p class='col-sm-12 requir required'>Une erreur est survenue ! Veuilez recommencez. </p>";
    }
}

include("footer.php");

?>
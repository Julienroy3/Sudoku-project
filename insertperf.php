<?php
include("connect.php");
session_start();

if(isset($_POST["valid_in"])){
    
    $time =  $_POST["time_end"];
    $level =  $_POST["level"];
    
    $rep = $bdd->prepare("SELECT * FROM Performances WHERE TempsResolu = :time AND level = :level");
    
    $rep->bindParam(":time", $time, PDO::PARAM_STR);
    $rep->bindParam(":level", $level, PDO::PARAM_STR);
    $rep->execute();
    
    $res = $rep->fetch();
    
    if($res){
        //$_SESSION["IdUser"] = $res["IdUser"];
        //$_SESSION["username"] = $res["username"];
        //header("Location: index.php");
        echo $time;
    }else{
        echo "<p class='required'>Une erreur est survenue ! Veuilez recommencez. <br> <a href='index.php'>Retour</a></p>";
    }
}


?>
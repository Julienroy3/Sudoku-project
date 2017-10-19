<?php
include("connect.php");
session_start();

if(isset($_POST["valid_in"])){
    
    $time =  $_POST["time_end"];
    $level =  $_POST["level"];
    $user = $_SESSION['IdUser'];
    
    $rep = $bdd->prepare("INSERT INTO Performances(DateResolu, TempsResolu, Niveau, IdUser) VALUES (CURDATE(), :time, :level, :user)");
    
    $rep->bindParam(":time", $time, PDO::PARAM_STR);
    $rep->bindParam(":level", $level, PDO::PARAM_STR);
    $rep->bindParam(":user", $user, PDO::PARAM_STR);
    $rep->execute();
    
    $res = $rep->fetch();
    
    header('Location: index.php');
}


?>
<?php
include("connect.php");
session_start();

if(isset($_POST["valid_in"])){
    
    $time =  $_POST["time_end"];
    $user = $_SESSION['IdUser'];
    $concours = $_POST['id_concours'];
    
    $rep = $bdd->prepare("INSERT INTO Participe(Temps, IdUser, IdConcours) VALUES (:time, :user, :concours)");
    
    $rep->bindParam(":time", $time, PDO::PARAM_STR);
    $rep->bindParam(":user", $user, PDO::PARAM_STR);
    $rep->bindParam(":concours", $concours, PDO::PARAM_STR);
    $rep->execute();
    
    header('Location: results.php');
    
    $rep->closeCursor();
    
    
    $rep2 = $bdd->prepare("SELECT * FROM Participe WHERE IdConcours =" . $concours . " ORDER BY Temps");
    $rep2->execute();
    $i = 1;
    while($donnees = $rep2->fetch()){
        $tempsdb = $donnees["Temps"];
        $classementdb = $donnees["Classement"];
        $classement = $i;
        echo $tempsdb. " " . $classementdb . " " . $classement . '<br>';
        
        $rep3 = $bdd->prepare("UPDATE Participe SET Classement =" . $classement . "WHERE Temps =" . $tempsdb);
        $rep3->execute();
        echo "ça a marché !" . $classement . $tempsdb;
        $reponse = $bdd->query("UPDATE Participe SET Classement = '" . $classement . "' WHERE Temps = '" . $tempsdb ."'") or die(print_r($bdd->errorInfo()));
        $rep3->closeCursor();
        
        $i++;
        
        
    }
        $rep2->closeCursor();
    
    
    
}



?>
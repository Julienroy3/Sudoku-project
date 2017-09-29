<?php 

include("connect.php");
session_start(); 

if (isset($_SESSION['id'])){
    
    $req = $bdd->prepare("SELECT * FROM users WHERE id = :id");
    $req->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    $req->execute();
    

    while ($donnees = $req->fetch()){
        
        echo "<p>Hello ". $donnees["username"]." !</p><br>
        <img src=icons/".$donnees["icon"]." width=90 heigh=90>
        <p><b>Your informations</b> <br>
        Email : ".$donnees["email"]."<br>
        Pseudo : ".$donnees["username"]."<br>
        Mot de passe : ******* <br>
        Date de création : ".$donnees["date_sign"]."<br>
        
        <a href='logout.php'>Déconnexion</a>";

    }

$req->closeCursor();
    
}else{
    echo "Tu n'est pas connecté ! <a href='sign_in.php'>Retour</a>";
}

?>
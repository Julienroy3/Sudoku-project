<?php 
include('header.php');

if (isset($_SESSION['IdUser'])){
    
    $req = $bdd->prepare("SELECT * FROM Utilisateur WHERE IdUser = :IdUser");
    $req->bindParam(":IdUser", $_SESSION["IdUser"], PDO::PARAM_INT);
    $req->execute();
    
    while ($donnees = $req->fetch()){
        
        echo "<div class='col-sm-12 profil'>
        <div class='img_p'><p class='text-center text-capitalize'>Hello ". $donnees["username"]." !</p><br>
        <img src=icons/".$donnees["icon"]." width=180 heigh=180></div>
        
        <div class='info_p'><h2><b>Tes informations</b></h2><br>
        Email : ".$donnees["email"]."<br>
        Pseudo : ".$donnees["username"]."<br>
        Mot de passe : ******* <br>
        Date de création : ".$donnees["date_sign"]."<br><br>
        
        <a href='logout.php'>Déconnexion</a></div></div>";
    }
$req->closeCursor();
    
}else{
    header('Location: sign_in.php');
}
require("script-sdk.js"); 
    require("footer.php");
?>
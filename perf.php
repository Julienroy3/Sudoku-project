<?php

require 'header.php';

if (isset($_SESSION['IdUser'])) {
	# code...
	$rep = $bdd->prepare("SELECT DateResolu, TempsResolu, Niveau FROM Performances WHERE IdUser = :IdUser");
	$rep->bindParam(":IdUser", $_SESSION['IdUser'], PDO::PARAM_INT);
	$rep->execute();
?>


	
	
<div class="container">
    <div class="row winner-array">
        <div class="col-md-3"></div>
        <div class="col-sm-12 col-md-6 text-center">
           <div class="results-array">
           <h2>Voici tes résultats !</h2>
            <div class="col-xs-4 col-md-4 winner-tab">Date</div>
            <div class="col-xs-4 col-md-4 winner-tab">Temps</div>
            <div class="col-xs-4 col-md-4 winner-tab">Niveau</div>
            <?php    
                while($donnees = $rep->fetch()){
            ?>
            <div class="col-xs-4 col-md-4"><?php echo $donnees["DateResolu"]; ?></div>
        <div class="col-xs-4 col-md-4"><?php echo $donnees["TempsResolu"]; ?></div>
        <div class="col-xs-4 col-md-4"><?php echo $donnees["Niveau"]; ?></div>
            <?php
                }
            ?>
            </div></div>
            <div class="col-md-3"></div>
        </div>
        </div>	
	
	

<?php
	
} else {
	# code...
	var_dump($_SESSION['IdUser']);
	die();
}

?>


 <?php include("footer.php"); ?>
 <?php include("script-sdk.php"); ?>
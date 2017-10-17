<!DOCTYPE html>
<html>
<?php include("connect.php");
      session_start(); 
      include 'header.php';
      include 'menu.php';
    
    $req = $bdd->prepare("SELECT * FROM Participe, Utilisateur, Concours WHERE Participe.IdUser = Utilisateur.IdUser AND Participe.IdConcours = Concours.IdConcours AND Classement = '1'");
    //$req->bindParam(":IdUser", $_SESSION["IdUser"], PDO::PARAM_INT);
    $req->execute();
    
?>
<body>
	<div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 center">
                <h1>Concours</h1>
                <a class="btn_contest" href="contest_join.php">Je participe</a>
		  </div>
        </div>
        
        <div class="row winner-array">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="col-xs-6 col-md-6 winner-tab">Date</div>
                <div class="col-xs-6 col-md-6 winner-tab">Vainqueur</div>
                
                <?php
                    while ($donnees = $req->fetch()){
                ?>
                <div class="col-xs-6 col-md-6"><?php echo $donnees["DateConcours"]; ?></div>
                <div class="col-xs-6 col-md-6"><?php echo $donnees["username"]; ?></div>
                <?php
                    }
                ?>
            </div>
            <div class="col-md-3"></div>
        </div>
        
	</div>
</body>
</html>
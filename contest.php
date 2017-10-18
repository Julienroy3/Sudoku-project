<!DOCTYPE html>
<html>
<?php include("connect.php");
      session_start(); 
      include 'header.php';
      include 'menu.php';
    
    $req = $bdd->prepare("SELECT Participe.Classement, Participe.IdUser, Participe.IdConcours, Utilisateur.IdUser, Utilisateur.username, Concours.IdConcours, Concours.DateConcours, @current := (SELECT MAX(Concours.IdConcours) FROM Concours) FROM Participe, Utilisateur, Concours WHERE Participe.IdUser = Utilisateur.IdUser AND Participe.IdConcours = Concours.IdConcours AND Classement = '1'");
    //$req = $bdd->prepare("SELECT Participe.Classement, Participe.IdUser, Participe.IdConcours, Utilisateur.IdUser, Utilisateur.username, Concours.IdConcours, max(Concours.IdConcours) as current, Concours.DateConcours FROM Participe, Utilisateur, Concours WHERE Participe.IdUser = Utilisateur.IdUser  AND Participe.IdConcours = Concours.IdConcours AND Classement = '1'");
    //$req = $bdd->prepare("SELECT max(IdConcours) FROM Concours WHERE 1");
    //$req->bindParam(":IdUser", $_SESSION["IdUser"], PDO::PARAM_INT);
    $req->execute();
    
    while ($donnees = $req->fetch()){
?>
<body>
	<div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 center">
                <h1>Concours</h1>
                <?php if(isset($_SESSION['IdUser'])) { ?>
                <a class="btn_contest" href="contest_join.php?idconcours=<?php echo $donnees["@current := (SELECT MAX(Concours.IdConcours) FROM Concours)"];?>">Je participe</a>
                <?php } else { ?>
                <a class="btn_contest" href="sign_up.php">Je participe</a>
                <?php } ?>
		  </div>
        </div>
        
        <div class="row winner-array">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="col-xs-6 col-md-6 winner-tab">Date</div>
                <div class="col-xs-6 col-md-6 winner-tab">Vainqueur</div>
                
                <?php
                    
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
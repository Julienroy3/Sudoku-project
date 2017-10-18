
<?php 
    include("connect.php");
      session_start(); 
      include 'header.php';
      include 'menu.php';
?>
<body>
    <?php
    
    $req2 = $bdd->prepare("SELECT MAX(Concours.IdConcours) as maxConcours FROM Concours");
    $req2->execute();
    
    while ($donnees = $req2->fetch()){
        ?>
    
    <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 center">
                    <h1>Concours</h1>
                    <?php if(isset($_SESSION['IdUser'])) { ?>
                    <a class="btn_contest" href="contest_join.php?idconcours=<?php echo $donnees["maxConcours"];?>">Je participe</a>
                    <?php } else { ?>
                    <a class="btn_contest" href="sign_up.php">Je participe</a>
                <?php } ?>
		  </div>
        </div>
    
    <?php
    }
    
    $req2->closeCursor();
    
    $req3 = $bdd->prepare("SELECT Participe.Classement, Participe.IdUser, Participe.IdConcours, Utilisateur.IdUser, Utilisateur.username, Concours.IdConcours, Concours.DateConcours FROM Participe, Utilisateur, Concours WHERE Participe.IdUser = Utilisateur.IdUser AND Participe.IdConcours = Concours.IdConcours AND Classement = '1'");
    $req3->execute();
        ?>
    
    <div class="row winner-array">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="col-xs-6 col-md-6 winner-tab">Date</div>
            <div class="col-xs-6 col-md-6 winner-tab">Vainqueur</div>
                
            <?php
                
            while($donnees = $req3->fetch()){ ?>

            <div class="col-xs-6 col-md-6"><?php echo $donnees["DateConcours"]; ?></div>
            <div class="col-xs-6 col-md-6"><?php echo $donnees["username"]; ?></div>
            <?php
                }
            $req3->closeCursor();
            ?>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
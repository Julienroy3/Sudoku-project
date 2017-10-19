
<?php include("header.php");

//next concours
$req2 = $bdd->prepare("SELECT IdConcours as maxConcours , DateConcours as dat, DATE_FORMAT(HeureDebut, '%Hh%i') as HD, DATE_FORMAT(HeureFin, '%Hh%i') as HF FROM Concours WHERE IdConcours = (SELECT MAX(Concours.IdConcours) FROM Concours) ");
$req2->execute();
    
while ($donnees = $req2->fetch()){
        ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 text-center">
        <h1>Concours</h1>
        <?php 
            echo "Prochain Concours : ".$donnees["dat"]."<br><br>
                    Heure de début : ".$donnees["HD"]."<br>
                    Heure de fin : ".$donnees["HF"]."<br><br>";
    
        //connected user can participate
        if(isset($_SESSION['IdUser'])) {
            
            //if date and hour is date's and hour's day
            if(($donnees["dat"] == date("Y-m-d")) AND ($donnees["HD"] <= date("H:i:s") AND date("H:i:s") <= $donnees["HF"])){
            ?>
            <br><a class="btn_contest" href="contest_join.php?idconcours=<?php echo $donnees["maxConcours"];?>">Je participe</a><br>
        
            <?php 
            }else{
                echo "Il n'y a pas de concours aujourd'hui.";
            }
        } else { ?>
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

<?php include("footer.php");

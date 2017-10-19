
<?php 
      include 'header.php';
?>
<body>
   
   <?php
    $req2 = $bdd->prepare("SELECT MAX(Concours.IdConcours) as maxConcours FROM Concours");
    $req2->execute();
    while($donnees2 = $req2->fetch()){
        $current = $donnees2["maxConcours"];
    }
    
    $req2->closeCursor();
   ?>
    
    <?php
    $req = $bdd->prepare("SELECT Participe.Classement, Participe.IdUser, Participe.IdConcours, Utilisateur.IdUser, Utilisateur.username, Concours.IdConcours, Concours.DateConcours FROM Participe, Utilisateur, Concours WHERE Participe.IdUser = Utilisateur.IdUser AND Concours.IdConcours = " . $current ." AND Participe.IdConcours = Concours.IdConcours ORDER BY Classement");
    $req->execute();
   
        ?>
    <div class="container">
    <div class="row winner-array">
        <div class="col-md-3"></div>
        <div class="col-sm-12 col-md-6 text-center">
           <div class="results-array">
           <h2>Voici le classement du concours !</h2>
            <div class="col-xs-6 col-md-6 winner-tab">Classement</div>
            <div class="col-xs-6 col-md-6 winner-tab">Utilisateur</div>
            <?php    
                while($donnees = $req->fetch()){
            ?>
            <div class="col-xs-6 col-md-6"><?php echo $donnees['Classement']; ?></div>
            <div class="col-xs-6 col-md-6"><?php echo $donnees['username']; ?></div>
            <?php
                }
            ?>
            </div></div>
            <div class="col-md-3"></div>
        </div>
        </div>
        <?php include("footer.php"); ?>
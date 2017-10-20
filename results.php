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
    $req3 = $bdd->prepare("SELECT Participe.Classement, Participe.IdUser, Participe.IdConcours, Utilisateur.IdUser, Utilisateur.username, Concours.IdConcours, Concours.DateConcours FROM Participe, Utilisateur, Concours WHERE Participe.IdUser = Utilisateur.IdUser AND Concours.IdConcours = " . $current ." AND Participe.IdConcours = Concours.IdConcours ORDER BY Classement");
    $req3->execute();
   
        ?>
       
    <div class="classement-array">
        <div class="col-md-3"></div>
        <div class="col-sm-12 col-md-6 text-center">
            <div class="col-xs-6 col-md-6 winner-tab">Classement</div>
            <div class="col-xs-6 col-md-6 winner-tab">Utilisateur</div>
            <?php    
                while($donnees = $req3->fetch()){
            ?>
            <div class="col-xs-6 col-md-6"><?php echo $donnees['Classement']; ?></div>
            <div class="col-xs-6 col-md-6"><?php echo $donnees['username']; ?></div>
            <?php
                }
            ?>
            </div>
            <div class="col-md-3"></div>
</div>
<?php
      require 'header.php';

//display results
    $req2 = $bdd->prepare("SELECT IdConcours FROM Concours WHERE DateConcours = '".date("Y-m-d")."' AND CONCAT(DateConcours,'-',HeureFin) <= '".date("Y-m-d-H-i-s")."'");
    $req2->execute();
    while($donnees2 = $req2->fetch()){
        $current = $donnees2["IdConcours"];
    }

    $req3 = $bdd->prepare("SELECT Participe.Classement, Participe.IdUser, Participe.IdConcours, Utilisateur.IdUser, Utilisateur.username, Concours.IdConcours, Concours.DateConcours FROM Participe, Utilisateur, Concours WHERE Participe.IdUser = Utilisateur.IdUser AND Concours.IdConcours = " . $current ." AND Participe.IdConcours = Concours.IdConcours ORDER BY Classement");
    $req3->execute();

        ?>

    <div class="winner-array">
        <div class="col-md-3"></div>
        <div class="col-sm-12 col-md-6 text-center">
          <h1 class="text-center">Classement</h1>
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


<?php
require("script-sdk.js");
require("footer.php"); ?>

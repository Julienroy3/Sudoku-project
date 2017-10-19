<?php
include 'header.php';

    //variables permettant de récupérer les données du concours
    $date = date('Y-m-d', strtotime($_POST["dateContest"]));
    $debut = date('H:i:s', strtotime($_POST["timeStart"]));
    $fin =  date('H:i:s', strtotime($_POST["timeEnd"]));
    $boardUn =  $_POST["level"];
//    $boardSolved =  $_POST["solvedtab"];
    //requête SQL
    $rep = $bdd->prepare("INSERT INTO Concours(GrilleConcours, DateConcours, HeureDebut, HeureFin,GrilleSolution) VALUES (:empty,:day,:start,:finish,:answer)");
      $rep->bindParam(":empty", $boardUn, PDO::PARAM_STR);
      $rep->bindParam(":day", $date, PDO::PARAM_STR);
      $rep->bindParam(":start", $debut, PDO::PARAM_STR);
      $rep->bindParam(":finish", $fin, PDO::PARAM_STR);
      $rep->bindParam(":answer", $boardSolved, PDO::PARAM_STR);
      $rep->execute();
      $rep->closeCursor();
?>
<div class="col-sm-12">
    <div class="col-md-offset-2 col-md-8">
      <div class="winner-array">
        <div class="col-xs-4 col-md-4 winner-tab">Date</div>
        <div class="col-xs-4 col-md-4 winner-tab">Heure de début</div>
        <div class="col-xs-4 col-md-4 winner-tab">Heure de fin</div>
        <?php
        $req = $bdd->prepare("SELECT DateConcours, HeureDebut, HeureFin FROM Concours WHERE DateConcours >= NOW() ORDER BY DateConcours,HeureDebut");
        $req->execute();
            while ($info = $req->fetch()){
        ?>
        <div class="col-xs-4 col-md-4"><?php echo $info["DateConcours"]; ?></div>
        <div class="col-xs-4 col-md-4"><?php echo $info["HeureDebut"]; ?></div>
        <div class="col-xs-4 col-md-4"><?php echo $info["HeureFin"]; ?></div>
        <?php
            }
        ?>
      </div>
    </div>
</div>

<?php include 'footer.php'; ?>
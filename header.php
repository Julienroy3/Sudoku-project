<?php require("connect.php");
      session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <title>Sudo -ku</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/sudokuJS.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="fonts/stylesheet.css">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
    			<!-- menu -->
                <?php require("menu.php");

                //display sudoku
                if (isset($_SESSION['IdUser'])){
                    $req = $bdd->prepare("SELECT * FROM Utilisateur WHERE IdUser = :IdUser");
                    $req->bindParam(":IdUser", $_SESSION["IdUser"], PDO::PARAM_INT);
                    $req->execute();
                    $req->closeCursor();
                }

                ?>

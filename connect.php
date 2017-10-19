<?php

try{
<<<<<<< Updated upstream
    $bdd = new PDO('mysql:host=localhost;dbname=sudoku;charset=utf8', 'root', 'root');
=======
    $bdd = new PDO('mysql:host=localhost:8181;dbname=sudoku;charset=utf8', 'root', 'root');
>>>>>>> Stashed changes
}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}

?>
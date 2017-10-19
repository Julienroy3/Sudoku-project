<?php

try{
    $bdd = new PDO('mysql:host=mysqldb;dbname=sudoku;charset=utf8', 'root', 'docker');
}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}

?>
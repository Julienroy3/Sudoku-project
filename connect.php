<?php

try{

    $bdd = new PDO('mysql:host=tiffanyfnctiffdb.mysql.db;dbname=tiffanyfnctiffdb;charset=utf8', 'tiffanyfnctiffdb', 'Waldorf24');

}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}

?>
<?php
    session_start();
    require_once("header.php");
    require_once("connexionBDD.php");
    require_once("fonctions.php");

    // echo($_GET['id']);

    $query = $pdo->prepare('DELETE FROM images WHERE id = :id');
    $query->execute(['id'=> $_GET['id']]);
    header('Location: mesphotos.php');

?>
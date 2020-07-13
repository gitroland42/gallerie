<?php

    require_once("connexionBDD.php");

    $query = $pdo->prepare('SELECT *FROM images WHERE id = :id');
    $query->execute(['id'=> $_GET['id']]);  // le id est affecte par le $_GET
    $fetchRes = $query->fetch();


?>
<a title="retour" href="mesphotos.php">retour mes photos</a>

<!-- <h1><?php echo($fetchRes['nomImage']) ?></h1><br> -->
<h2><u>Date : </u> <?php echo($fetchRes['dateImage']) ?></h2>
<h2><u>Lieu : </u> <?php echo($fetchRes['lieuImage']) ?></h2>
<h2><u>Public : </u> <?php echo($fetchRes['estPublic']) ?></h2>
<img src="<?php echo('Telechargement/'.$fetchRes['nomImage']); ?>" alt="">
<?php
    session_start();
    require_once("connexionBDD.php");
    require_once("header.php");
    require_once("fonctions.php");
    
?>


<!DOCTYPE html>
<html lang="fr">

<body>
  
    <?php
    
    if(!isset($_SESSION['idconnecte'])){
        //echo("public");
        $reponse = $pdo->query('SELECT *FROM images where estPublic=1');
    }
    elseif($_SESSION['idconnecte']===0) {
            //echo("public");
        $reponse = $pdo->query('SELECT *FROM images where estPublic=1');
    }
    else{?>
   
        <h1><?php echo("Bonjour ".$_SESSION['userconnecte']);?></h1>
   <?php
        $reponse = $pdo->query('SELECT *FROM images');
    }
          
    ?>
     
     <!-- <a title="ajout" href="addplanet.php">ajouter</a> -->
    <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">Date</th>
            <th scope="col">Image</th>
            <th scope="col">Lieu</th>
            <!-- <th scope="col">Image</th> -->
      
            </tr>
        </thead>
         <tbody>

         <?php
            // var_dump($reponse->fetchAll());

            while ($data = $reponse->fetch())
            {
            ?>
            <tr>
            <td><?php echo(date("d-m-Y",strtotime($data['dateImage']))); ?></td>
            <td><img height="250" width="338" src="<?php echo('Telechargement/'.$data['nomImage']); ?>"/></td>
            <td><?php echo($data['lieuImage']); ?></td>
           
            <?php    
             }
             $reponse->closeCursor();
             ?>
        </tbody>
    </table>


</body>
</html>
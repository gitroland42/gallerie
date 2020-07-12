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
    else{
   //echo("prive");
        echo("Bonjour ".$_SESSION['userconnecte']);
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
            <td><?php echo($data['dateImage']); ?></td>
            <td><img src="<?php echo('Telechargement/'.$data['nomImage']); ?>"/></td>
            <!-- <td><?php echo('Telechargment/'.$data['nomImage']); ?></td> -->
            <td><?php echo($data['lieuImage']); ?></td>
           
            <!-- <td>
            <a title="Voir le détail" href="planetdetail.php?id=<?php echo($data['id']); ?>">Voir le détail</a>
            </td>
            <td>    
            <a title="Editer" href="editplanet.php?id=<?php echo($data['id']); ?>">editer</a>
            
            </td> -->
            <?php    
             }
             $reponse->closeCursor();
             ?>
        </tbody>
    </table>




</body>
</html>
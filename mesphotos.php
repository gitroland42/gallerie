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
    
    if(isset($_SESSION['idconnecte'])){
        //requete sur les photos de l'utilisateur
        $reponse = $pdo->query('SELECT *FROM images where id_user='.$_SESSION['idconnecte']);
    }
    else{
        header('Location: index.php');
    }
       
       
    ?>
     
    <a title="ajout" href="addphoto.php">ajouter</a>
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
            <td><img  height="250" width="338" src="<?php echo('Telechargement/'.$data['nomImage']); ?>"/></td>
            <!-- <td><?php echo('Telechargment/'.$data['nomImage']); ?></td> -->
            <td><?php echo($data['lieuImage']); ?></td>
           
            <td>
            <a title="Détail" href="detailphoto.php?id=<?php echo($data['id']); ?>">Détail</a>
            </td>
            <td>    
            <a title="Editer" href="editphoto.php?id=<?php echo($data['id']); ?>">editer</a>
            
            </td> 
            <td>    
            <a title="Editer" href="supprphoto.php?id=<?php echo($data['id']); ?>">supprimer</a>
            
            </td> 
            <?php    
             }
             $reponse->closeCursor();
             ?>
        </tbody>
    </table>




</body>
</html>
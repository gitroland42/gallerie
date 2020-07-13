<?php
    session_start();
    require_once("header.php");
    require_once("connexionBDD.php");
    require_once("fonctions.php");



    $query = $pdo->prepare('SELECT * FROM utilisateur WHERE id = :id');
    $query->execute(['id'=> $_SESSION['idconnecte']]);  // le id est affecte par le $_GET
    $fetchRes = $query->fetch();



    $errors=[];
?>
<div class="col-md-6">
    <div class="card text-light border-light p-5" style="height: auto; background-color: #1e1d1d">
        <form id="center" #planetForm="ngForm" method="post" action="moncompte.php" enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="nomUser">Nom</label>
            <input type="text" class="form-control" id="nomUser" name="nomUser" value=<?php echo($fetchRes['nomUser']) ?>>
          
        </div>
        <div class="form-group">
            <label for="prenomUser">Prénom</label>
            <input type="text" class="form-control" id="prenomUser" name="prenomUser" value=<?php echo($fetchRes['prenomUser']) ?> > 
        </div>
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" value=<?php echo($fetchRes['pseudo']) ?> > 

    
        </div>
        <div class="form-group">
            <label for="motdepasse">Mot de passe</label>
            <input type="password" disabled class="form-control" id="motdepasse" name="motdepasse" value=<?php echo($fetchRes['motdepasse']) ?>>
        </div>
       
        <button type="submit" class="btn btn-outline-success">Modifier</button>
        <?php
            
            if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
                $errors = testErreurs_compte($pdo); 
               
                // $errors = $returnValidation['errors'];
                if( count($errors) === 0) {
                    modif_Compte($pdo);
                    header('Location: index.php');
                }
                

                if(count( $errors) != 0){
                // echo(' <h2>Erreurs lors de la dernière soumission du formulaire : </h2>');
                foreach ( $errors as $error){
                echo('<div class="error">'.$error.'</div>');
                }
                }
            }
            ?>
        </div>
    </div>
</form>
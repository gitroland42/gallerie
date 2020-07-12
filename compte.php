<?php

    require_once("header.php");
    require_once("connexionBDD.php");
    require_once("fonctions.php");
    $errors=[];
?>
<div class="col-md-6">
    <div class="card text-light border-light p-5" style="height: auto; background-color: #1e1d1d">
        <form id="center" #planetForm="ngForm" method="post" action="compte.php" enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="nomUser">Nom</label>
            <input type="text" class="form-control" id="nomUser" name="nomUser">
          
        </div>
        <div class="form-group">
            <label for="prenomUser">Prénom</label>
            <input type="text" class="form-control" id="prenomUser" name="prenomUser" > 
        </div>
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" > 

    
        </div>
        <div class="form-group">
            <label for="motdepasse">Mot de passe</label>
            <input type="password" class="form-control" id="motdepasse" name="motdepasse" >
        </div>
        <!-- <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <button type="submit" class="btn btn-outline-success">Valider</button>
        <?php
            
            if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
                $errors = testErreurs_compte(); 
               
                // $errors = $returnValidation['errors'];
                if( count($errors) === 0) {
                    ajout_Compte($pdo);
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
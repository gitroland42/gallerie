<?php
    session_start();
    require_once("header.php");
    require_once("connexionBDD.php");
    require_once("fonctions.php");
    $errors=0;

    if(isset($_SESSION['idconnecte'])){
        session_destroy();
       // $_SESSION['idconnecte']=0;
        //$_SESSION['userconnecte']="";
        header('Location: index.php');
        
    }
?>

<div class="col-md-6">
    <div class="card text-light border-light p-5" style="height: auto; background-color: #1e1d1d">
        <form id="center" #planetForm="ngForm" method="POST" action="connexion.php" enctype="multipart/form-data">

            <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo">
            </div>
            <div class="form-group">
                <label for="motdepasse">Mot de passe</label>
                <input type="password" class="form-control" id="motdepasse" name="motdepasse">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">se souvenir de moi</label>
            </div>
            <button type="submit" class="btn btn-outline-success">Connexion</button>
            <?php
            
            if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
                $errors = verif_compte($pdo); 
                         
                // $errors = 0 connexion ok , = 1 connexion echoué
                if($errors === false) {
                    echo("Combinaison pseudo/mot de passe invalide");
                 }
                 else{
                   // $idConnecte=$errors[0];
                   // $userconnecte=$errors[1];
                    //echo($userconnecte);
                    $_SESSION['idconnecte']=$errors[0];
                    $_SESSION['userconnecte']=$errors[1];
                    
                    header('Location: index.php');
                };
                

            }
            ?>
        </div>
        </form>
    </div>
</div>
        
<?php
    session_start();
    require_once("header.php");
    require_once("connexionBDD.php");
    require_once("fonctions.php");
    $errors=[];

    $idPhoto = $_GET['id'];    
    $photo = recherche_photoID($pdo, $idPhoto);



?>

<div class="col-md-6">
    <div class="card text-light border-light p-5" style="height: auto; background-color: #1e1d1d">
    <form id="center" method="post" action="editphoto.php?id=<?php echo($idPhoto);?>" enctype="multipart/form-data">

        
        <label for="dateImage">saisir la date ?</label>
        <input type="date" class="form-control" id="dateImage" name="dateImage" value="<?php echo($photo['dateImage']) ?>">
        <br>
        <div>
            <img src= <?php echo('telechargement/'.$photo['nomImage'])?>>
            <label for="nomImage">Selectionner une photo</label>    
            <input type="file" name="nomImage" > <br><br>

        </div>
        <br>
        <label for="lieuImage">saisir le lieu ?</label>
        <input type="text" class="form-control" id="lieuImage" name="lieuImage" value="<?php echo($photo['lieuImage']) ?>">
        <br>
        <div class="form-check">
       <!-- <input type="checkbox" class="form-check-input" id="estPublic" name="estPublic" value="<?php echo($photo['estPublic']) ?>"> --> 
       <?php
        if ($photo['estPublic']==="1"){?>
            <input type="checkbox" class="form-check-input" id="estPublic" name="estPublic" checked>
        <?php
        }
        else{?>
            <input type="checkbox" class="form-check-input" id="estPublic" name="estPublic">
        <?php
        }
        ?>
        <!-- <input type="checkbox" class="form-check-input" id="estPublic" name="estPublic"  -->
      
        <label class="form-check-label" for="estPublic" >Photo public</label>
        </div>
    

        <input type="submit">
        <?php
        
        if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
            $returnValidation = testErreursAjoutImage(); 
            
            $errors = $returnValidation['errors'];
            if( count($errors) === 0) {
                maj_BDD_Images($pdo, $returnValidation['image'], $idPhoto);
                header('Location: mesphotos.php');
            }
            

            if(count( $errors) != 0){
            
            foreach ( $errors as $error){
            echo('<div class="error">'.$error.'</div>');
            }
            }
        }
        ?>

    </form>
    </div>
</div>

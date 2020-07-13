
<?php

    function pseudo_unique($pdo,$pseudo){
        $query = $pdo->prepare('SELECT * FROM utilisateur WHERE pseudo = :pseudo');
       
        $query->execute([
            'pseudo' => $pseudo
            
        ]);

        $fetchRes = $query->fetch();
        return($fetchRes);
    }

    // 'pseudo' => $_POST['pseudo'],

    function testErreurs_compte($pdo){
        $errors=[];

        if(pseudo_unique($pdo,$_POST['pseudo'])!==false){
            $errors[]="erreur pseudo deja crée";
        }
     

      // echo(isset($_POST['nomUser']));
        if (isset($_POST['nomUser']) && empty($_POST['nomUser'])) {
            $errors[]="erreur nom obligatoire";
        } 

        if (isset($_POST['prenomUser']) && empty($_POST['prenomUser'])) {
            $errors[]="erreur prénom obligatoire";
        } 

        if (isset($_POST['pseudo']) && empty($_POST['pseudo'])) {
            $errors[]="erreur pseudo obligatoire";
        } 

        if (isset($_POST['motdepasse']) && strlen($_POST['motdepasse'])<8) {
            $errors[]="erreur le mot de passe doit avoir au minimun 8 caracteres";
        }  

        // if (empty($_POST['motdepasse'])) {
        //     $errors[]="erreur mot de passe obligatoire";
        // }      
       
        return $errors;
    }


    function ajout_compte($pdo){

        $req = $pdo->prepare(
        'INSERT INTO utilisateur(nomUser, prenomUser, pseudo , motdepasse)
        VALUES(:nomUser, :prenomUser, :pseudo, :motdepasse)');
        $req->execute([
        'nomUser' => $_POST['nomUser'],
        'prenomUser' => $_POST['prenomUser'],
        'pseudo' => $_POST['pseudo'],
        'motdepasse' => md5($_POST['motdepasse'])
               
        ]);
        
    }



    function modif_compte($pdo){

        $req = $pdo->prepare(
        'UPDATE utilisateur SET nomUser= :nomUser, prenomUser = :prenomUser, pseudo = :pseudo WHERE id = :id');
       
        $req->execute([
        'nomUser' => $_POST['nomUser'],
        'prenomUser' => $_POST['prenomUser'],
        'pseudo' => $_POST['pseudo'],
        'id'=> $_SESSION['idconnecte']     
        ]);
        //pas de modif du mot de pase
        //'motdepasse' => md5($_POST['motdepasse']),
        
    }
    function verif_compte($pdo){

        // global $userconnecte; 
        $query = $pdo->prepare('SELECT id,pseudo FROM utilisateur WHERE pseudo = :pseudo and motdepasse= :motdepasse');
        // $query->execute(['id'=> $_GET['id']]);  // le id est affecte par le $_GET
        //$query->execute(['pseudo'=> $pseudo],'motdepasse=>');
        // echo(md5($_POST['motdepasse']));
        $query->execute([
            'pseudo' => $_POST['pseudo'],
            'motdepasse' =>md5($_POST['motdepasse'])
        ]);

        $fetchRes = $query->fetch();
        // $userconnecte='toto';
        // var_dump($userconnecte);

        // if ($fetchRes!=false){
        //     $idConnecte=$fetchRes[0];
        //  $userconnecte=$fetchRes[1];
        // }
     
       return $fetchRes;


        
    }



    function testErreursAjoutImage(){
        $errors=[];
        $nomFic='';
    
        if (empty($_POST['dateImage'])) {
            $errors[]="erreur: date obligatoire";
          } 
    
        if (empty($_POST['lieuImage'])) {
            $errors[]="erreur: lieu obligatoire";
          } 
    
            
        // test photo si pas d'erreur avant
        if (count($errors) ==0){ 
            if (isset($_FILES['nomImage']) AND $_FILES['nomImage']['error'] == 0) {
                // Testons si le fichier n'est pas trop gros
                if ($_FILES['nomImage']['size'] <= 1000000)
                {
                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($_FILES['nomImage']['name']);
                    $extension_upload = $infosfichier['extension'];
                    $fichier_type = $_FILES['nomImage']['type'];
                    $extensions_autorisees = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');
                    if (in_array($fichier_type , $extensions_autorisees))
                    {
                
                        $nomFic=uniqid().'.'.$extension_upload;
                    
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['nomImage']['tmp_name'], 'Telechargement/'.$nomFic);
                    }else{
                        $errors[]="format de l'image incorrect";
                    }
                }else{
                    $errors[]="taille de l'image incorrect"; 
                }
            }
        }  
        
        
        return ['errors'=>$errors,'image'=>$nomFic];
    }
    


    function ajoutImage($pdo, $imageUrl){

        // pour ne pas avoir null dans la base de donnée
        if(isset($_POST['estPublic'])){
            $coche=1;
        }
        else
        {
            $coche=0;
        }

        $req = $pdo->prepare(
        'INSERT INTO images(dateImage, estPublic, nomImage , lieuImage, id_user)
        VALUES(:dateImage, :estPublic, :nomImage, :lieuImage, :id_user)');
        $req->execute([
        'dateImage' => $_POST['dateImage'],
        'estPublic' => $coche,
        'nomImage' => $imageUrl,
        'lieuImage' => $_POST['lieuImage'],
        'id_user'=> $_SESSION['idconnecte']
        ]);
    }

    

    function recherche_photoID($pdo,$imageid){

        $query = $pdo->prepare('SELECT * FROM images WHERE id = :idimage');
       
        $query->execute([
            'idimage' => $imageid
            
        ]);

        $fetchRes = $query->fetch();
        return($fetchRes);

    }

    function maj_BDD_Images($pdo,$imageUrl,$id){
         if(isset($_POST['estPublic'])){
             $coche=1;
         }
         else
         {
             $coche=0;
         }
         //$lastupdated = date("Y-m-d",$_POST['dateImage']);
         //echo($id."     ".$lastupdated);
         
        //   si une nouvelle image est chargée
         
            if(!is_null($imageUrl) && empty($imageUrl)){
            //   echo("oui modif"." ".$_POST['dateImage']." ".$coche);
              $req = $pdo->prepare('UPDATE images SET dateImage = :dateImage, lieuImage = :lieu, estPublic = :estPublic WHERE id = :id');
              $req->execute([
              'dateImage' => $_POST['dateImage'],
              'lieu' => $_POST['lieuImage'],
              'estPublic' => $coche,
              'id'=> $id
              ]);
            }
            else{
            //    echo("non"."  ".$id." image ".$imageUrl);
            //    echo("modif"." ".$_POST['dateImage']." ".$coche);
            
             // $req = $pdo->prepare('UPDATE images SET dateImage = :dateImage, lieuImage = :lieu, estPublic= :estPublic, nomImage = :img WHERE id = :id');
              $req = $pdo->prepare('UPDATE images SET dateImage = :dateImage, lieuImage = :lieu, estPublic= :estPublic, nomImage = :img WHERE id = :id');
              $req->execute([
                'dateImage' => $_POST['dateImage'],
                'lieu' => $_POST['lieuImage'],
                'estPublic' => $coche,
                'img' => $imageUrl,
                'id'=> $id
              ]);

            }

    }
?>

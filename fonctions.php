
<?php



    function testErreurs_compte(){
        $errors=[];
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

        if (strlen($_POST['motdepasse'])<8) {
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
        'motdepasse' => $_POST['motdepasse']
               
        ]);
        
    }

    function verif_compte($pdo){

           global $userconnecte; 
        $query = $pdo->prepare('SELECT id,pseudo FROM utilisateur WHERE pseudo = :pseudo and motdepasse= :motdepasse');
        // $query->execute(['id'=> $_GET['id']]);  // le id est affecte par le $_GET
        //$query->execute(['pseudo'=> $pseudo],'motdepasse=>');

        $query->execute([
            'pseudo' => $_POST['pseudo'],
            'motdepasse' => $_POST['motdepasse']
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
        if($_POST['estPublic']!==0){
            $public=0;
        }else{
            $public=1;
        }

        $req = $pdo->prepare(
        'INSERT INTO images(dateImage, estPublic, nomImage , lieuImage, id_user)
        VALUES(:dateImage, :estPublic, :nomImage, :lieuImage, :id_user)');
        $req->execute([
        'dateImage' => $_POST['dateImage'],
        'estPublic' => $public,
        'nomImage' => $imageUrl,
        'lieuImage' => $_POST['lieuImage'],
        'id_user'=> $_SESSION['idconnecte']
        ]);
        }
?>

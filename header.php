<?php
    require_once("fonctions.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Gallerie photos</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a 
          <?php
            if(isset($_SESSION['idconnecte'])){?>
              class="nav-link" href="mesphotos.php">Mes photos</a>
            <?php
            }
            else{?>
               class="nav-link disabled" href="#">Mes photos</a>
            <?php
            }?>
      </li>
     
      <li class="nav-item">
      <a 
          <?php
            if(isset($_SESSION['idconnecte'])){?>
              class="nav-link" href="#">Mon compte</a>
            <?php
            }
            else{?>
               class="nav-link disabled" href="#">Mon compte</a>
            <?php
            }?>
      </li>
    </ul>
    
    <form class="form-inline my-2 my-lg-0">
        <a href="compte.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Créer un compte</a>
        <!-- <a href="connexion.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Se connecter</a> -->
        <a href="connexion.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">
          <?php
             if(isset($_SESSION['idconnecte'])){?>
                Deconnexion</a>
            <?php
             }
             else{?>
                Se Connecter</a>
            <?php
             }?>
    </form>
  </div>
</nav>

</h2>



</body>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="profileStyle.css">
        <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
        <title>Profile de <?php echo $_SESSION['name'] ?></title>
    </head>

    <body>
        
        <?php include ('header.php');?>
        <div class="text">
        <?php 
            if ($_SESSION['name'] == "admin"){?>
                <div class = "addMusic">
                    <a href="ajoutDonnees.php">Ajouter des données (Admin only)</a>
                </div>
            <?php ; }
        ?>
            <div class="likes">
                <a href="likes.php">Vos likes</a>
            </div>
        </div>
        
        <footer>
            <div class = "disconnect">
                <a href = "deconnexion.php">Deconnectez vous !</a>
            </div>
        </footer>
    </body>
</html>
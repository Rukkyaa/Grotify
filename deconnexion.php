<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="deconnexionStyle.css">
        <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
        <title>Profile de <?php echo $_SESSION['name'] ?></title>
    </head>

    <body>
        <?php include ('header.php'); ?>
        
        <!--<div class = "text"> 
            <p> Vous avez été déconnecté </p>
        </div> -->
    </body>
</html>
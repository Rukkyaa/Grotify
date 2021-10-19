<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styles/profileStyle.css">
        <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
        <title>Profile de <?php echo $_SESSION['name'] ?></title>
    </head>

    <body>
        <header>
            <div class = "logo">
                <a href="accueil.php"><img src="images/logo.jpg"></a>
            </div>
        </header>
    </body>
</html>
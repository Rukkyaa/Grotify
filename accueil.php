<?php
session_start();
#$_SESSION['name'] = NULL;
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styles/accueilStyle.css">
        <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
        <title>Grotify</title>
    </head>

    <body>
        <header>
            <img class = "logo" src="images/logo.jpg">

            <?php
                if (isset($_SESSION['name'])){
                    echo "Bonjour " . $_SESSION['name'];
                } else {?>
                    <nav>
                        <ul class = "nav_links">
                            <li><a href="connexion.php">Se connecter</a></li>
                        </ul>
                    </nav>
                <?php ;}?>
        </header>

        <div class = "video">
            <iframe width="420" height="315"
                src="https://www.youtube.com/embed/M2l-X9M6zAo">
            </iframe> 

            <iframe width="420" height="315"
                src="https://www.youtube.com/embed/GIJ3bL5AtQw">
            </iframe>   
        </div>
    </body>
</html>
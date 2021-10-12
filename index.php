<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Grotify</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Kenia&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ephesis&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Haut de la page -->
    <header>
        <div class = "title">
            <div class = "title-box">
                <!-- Titre de la page -->
                <h1>Grotify</h1>

                <!-- Slogan de la page -->
                <p>De la musique pour tout les goûts !</p>
            </div>

            <div class = "slider">
                <div class = "slides">
                    <div class = "slide"><img src="images/slider1.jpg"></div>
                    <div class = "slide"><img src="images/slider2.jpg"></div>
                    <div class = "slide"><img src="images/slider3.jpg"></div>
                    <div class = "slide"><img src="images/slider4.jpg"></div>
                    <div class = "slide"><img src="images/slider5.jpg"></div>
                </div>
            </div>
        </div>
        

        <div class = "inscription">
            <img src="images/icon_user.png">
            <a href="inscription.php">S'inscrire</a>
            <a href="connexion.php">Se connecter</a>
        </div>

        <a href="accueil.php">Accueil</a>

    </header> 
</body>

</html>
<head>
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
</head>

<header>
    <a href="index.php"><img class = "logo" src="images/logo.jpg"></a>
    
    <?php
        if (isset($_SESSION['name'])){?>
            <div class = "profile">
                <a href="profile.php"><img src="images/icon_user.png"></a>
            </div>
        <?php
        } else {?>
            <div class = "connexionButton">
                <a href="connexion.php">Se connecter</a>
            </div>
        <?php 
        ;}?>
</header>
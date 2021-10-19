<?php
session_start();
#session_destroy();
$bdd = new SQLite3('db_grotify.db');

function urlToEmbed($urlYTB){

    $urlYTB = str_replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/", $urlYTB);
    echo $urlYTB;
}

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
                if (isset($_SESSION['name'])){?>
                    <div class = "profile">
                        <a href="profile.php"><img src="images/icon_user.png"></a>
                    </div><?php
                } else {?>
                    <nav>
                        <ul class = "nav_links">
                            <li><a href="connexion.php">Se connecter</a></li>
                        </ul>
                    </nav>
                <?php ;}?>
        </header>
        <?php
            $stmt = $bdd->prepare("SELECT music_url FROM Music INNER JOIN Artist ON Artist.artist_id = Music.artist_id WHERE Artist.name= :name");
            $stmt->bindValue(":name", "Wejdene", SQLITE3_TEXT);
            $req = $stmt->execute();?>

            <div class = "video">
            <?php
            while ($donnees = $req->fetchArray())
			{
			    ?>
                    <iframe width="420" height="315"
                        src="<?php echo $donnees['music_url']?>">
                    </iframe> 
                    <?php ;
			}?>

            <?php 
                urlToEmbed("https://www.youtube.com/watch?v=jdRE5jJUWhg")
            ?>


            </div>
        <!--
        <div class = "video">
            <iframe width="420" height="315"
                src="https://www.youtube.com/embed/M2l-X9M6zAo">
            </iframe> 

            <iframe width="420" height="315"
                src="https://www.youtube.com/embed/GIJ3bL5AtQw">
            </iframe>   
        </div>-->

    </body>
</html>
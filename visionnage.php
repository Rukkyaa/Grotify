<?php
session_start();
$bdd = new SQLite3('db_grotify.db');
include('fonction.php');
$information = getInformationById($bdd,$_GET['musiqueId']);

if (isset($_GET['like'])){
    if ($_GET['like'] == "FALSE"){
        dislike($bdd, $_SESSION['user_id'], $information['music_id']);
    } else {
        like($bdd, $_SESSION['user_id'], $information['music_id']);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./styles/visionnageStyle.css">
        <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
        <title>Visionnage de musique</title>
    </head>

    <body>
        <?php include ('header.php');?>

        <div class = "video">
            <h2><?php echo $information['music_name']?> ( <?php echo getTimeBySecond($information['music_time'])?> )</h2>
            <iframe width="420" height="315"
                src="<?php echo getUrlById($bdd, $_GET['musiqueId']) ?>">
            </iframe>

            <?php 
                if (getUserLikeByMusique($bdd, $_SESSION['user_id'], $information['music_id'])){?>
                    <a href="visionnage.php?musiqueId=<?php echo getNameByImgUrl($bdd, $information['music_thumbnail']) ?>&like=FALSE"><img src="images/like.png"></a>
                    <?php
                } else {?>
                    <a href="visionnage.php?musiqueId=<?php echo getNameByImgUrl($bdd, $information['music_thumbnail']) ?>&like=TRUE"><img src="images/dislike.png"></a>
                    <?php
                }
            ?>

            
        </div>

    </body>
</html>
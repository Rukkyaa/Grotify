<?php
session_start();
$bdd = new SQLite3('db_grotify.db'); #Stockage de la base de données dans la variable "$bdd"
include('fonction.php');
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./styles/likesStyle.css">
        <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
        <title>Likes de <?php echo $_SESSION['name'] ?></title>
    </head>

    <body>
        <?php include ('header.php');?>
        
        <?php 
            $results = [];
            $request = getAllLikesFromUser($bdd, $_SESSION['user_id']);
            
            while ($donnees = $request->fetchArray()){
                array_push($results, $donnees['music_id']); #On les ajoutes dans une liste
            }?>

            <div class="videos">

            <?php
                foreach ($results as $result) {
                    $information = getInformationById($bdd, $result);?>
                <div class="video">
                    <h2><?php echo $information['music_name']?> ( <?php echo getTimeBySecond($information['music_time'])?> )</h2>
                    <a href="visionnage.php?musiqueId=<?php echo getNameByImgUrl($bdd, $information['music_thumbnail']) ?>"><img src="<?php echo $information['music_thumbnail']?>"></a>
                </div>


                    <?php
                }
            ?>

            </div>

    </body>
</html>
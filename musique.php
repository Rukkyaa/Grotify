<?php
session_start();
$bdd = new SQLite3('db_grotify.db');
include('fonction.php');
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./styles/accueilStyle.css">
        <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
        <title>Musique de type <?php echo $_GET['type'] ?></title>
    </head>

    <body>
        <?php include ('header.php');?>

        <div class="video">
        <h1>Musique de type : <?php echo $_GET['type']?> </h1>

        <?php
        $result = [];
        $req = getMusicType($bdd, $_GET['type']); #On prend toutes les musique "type"

        while ($donnees = $req->fetchArray()){
            array_push($result, $donnees['music_thumbnail']); #On les ajoutes dans une liste
        }

        ?><div><?php
        for ($i=0; $i < count($result); $i++) {?>
            <a href="visionnage.php?musiqueId=<?php echo getNameByImgUrl($bdd, $result[$i]) ?>"><img src="<?php echo $result[$i]?>"></a>
            <?php
            }
            ?>
            </div>
        </div>
        
    </body>
</html>
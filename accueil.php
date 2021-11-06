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
        <link rel="stylesheet" type="text/css" href="accueilStyle.css">
        <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
        <title>Grotify</title>
    </head>

    <body>
        <?php include('header.php'); #Header de la page?>
        <div class = "video">
            <?php
            $result = [];
            $types = array("rock","pop","jazz","rap","punk","hiphop","rnb","electro");
            
            #Pour chaque type de musique
            foreach ($types as $type) {?>
                <h1>Musique <?php echo $type ?></h1>
            <?php
                $req = getMusicType($bdd, $type); #On prend toutes les musique "type"

                while ($donnees = $req->fetchArray()){
                    array_push($result, $donnees['music_thumbnail']); #On les ajoutes dans une liste
                }

                shuffle($result); #Pour afficher a chaque fois des musiques différentes

                ?><div><?php
                for ($i=0; $i < 3; $i++) {?>
                    <a href="visionnage.php?musiqueId=<?php echo getNameByImgUrl($bdd, $result[$i]) ?>"><img src="<?php echo $result[$i]?>"></a>
                <?php
                }
                $result= [];
                ?>
                </div><?php
            }?>
        </div>
    </body>
</html>
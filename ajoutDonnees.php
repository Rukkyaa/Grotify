<?php
session_start();
$bdd = new SQLite3('db_grotify.db');
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="ajoutDonneesStyle.css">
        <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
        <title>Ajout de données</title>
    </head>

    <body>
        
        <?php include ('header.php');?>
        
        <!--------------------------------------------------------------------------------------------------------------------
                                        _             _     _         _                                                       
                                       / \     _ __  | |_  (_)  ___  | |_    ___                                              
                                      / _ \   | '__| | __| | | / __| | __|  / _ \                                             
                                     / ___ \  | |    | |_  | | \__ \ | |_  |  __/                                             
                                    /_/   \_\ |_|     \__| |_| |___/  \__|  \___|                                             
                                                                                                                              
        ---------------------------------------------------------------------------------------------------------------------> 

        <div class = "formulaireArtiste">
            <form action="ajoutDonnees.php" method="post">
                <p>Ajout d'un artiste :</p>

                <div>
                    <label for="artist_name">Nom :</label>
                    <input type="text" id="artist_name" name="artist_name" required>
                </div>

                <div>
                    <label for="artist_country">Pays :</label>
                    <input type="artist_country"  id="artist_country" name="artist_country" required>
                </div>

                <div class="button">
                <button type="submit">Ajouter l'artist</button>
                </div>
            </form>
        </div>

        <?php 
        if (isset($_POST['artist_name']) and isset($_POST['artist_country'])){ #Si on a les données
            $artist_name = $_POST['artist_name'];
            $artist_country = $_POST['artist_country'];

            
            #On vérifie si il y a déjà l'artiste dans la BDD
            $stmt = $bdd->prepare("SELECT name FROM Artist WHERE name = :artist_name");
            $stmt->bindValue(":artist_name", $artist_name, SQLITE3_TEXT);
            $req = $stmt->execute();
            
            $donnees = $req -> fetchArray();

            if ($artist_name == $donnees['name']){
                ?>
                <div class = "error_add">
                    <p>L'artiste est déjà enregistré !</p>
                </div>
                <?php
            } else {
                #On ajoute l'artiste a la BDD
                $stmt = $bdd->prepare("INSERT INTO Artist
                                        (name, country, numberOfSong, numberOfViews)
                                        VALUES
                                        (:artist_name, :artist_country, 0, 0)");
                $stmt -> bindValue(":artist_name", $artist_name, SQLITE3_TEXT);
                $stmt -> bindValue(":artist_country", $artist_country, SQLITE3_TEXT);
                $stmt -> execute();?>

                <div class = "add_valid">
                    <p>Artiste ajouté !</p>
                </div>
                <?php
            }
        } 
    ?>

        <!--------------------------------------------------------------------------------------------------------------------
                                     __  __                 _                                                                 
                                    |  \/  |  _   _   ___  (_)   __ _   _   _    ___                                          
                                    | |\/| | | | | | / __| | |  / _` | | | | |  / _ \                                         
                                    | |  | | | |_| | \__ \ | | | (_| | | |_| | |  __/                                         
                                    |_|  |_|  \__,_| |___/ |_|  \__, |  \__,_|  \___|                                         
                                                                   | |                                                        
                                                                   |_|                                                                                               
        ---------------------------------------------------------------------------------------------------------------------> 

        <div class = "formulaireArtiste">
            <form action="ajoutDonnees.php" method="post">
                <p>Ajout d'un artiste :</p>

                <div>
                    <label for="artist_name">Nom :</label>
                    <input type="text" id="artist_name" name="artist_name" required>
                </div>

                <div>
                    <label for="artist_country">Pays :</label>
                    <input type="artist_country"  id="artist_country" name="artist_country" required>
                </div>

                <div class="button">
                <button type="submit">Ajouter l'artist</button>
                </div>
            </form>
        </div>
    </body>
</html>
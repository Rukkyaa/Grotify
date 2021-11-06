<?php
session_start();
$bdd = new SQLite3('db_grotify.db');
include ('fonction.php')
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./styles/ajoutDonneesStyle.css">
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

        <div class = "formulaire">
            <form action="ajoutDonnees.php" method="post">
                <p>Ajout d'un artiste :</p>

                <div>
                    <label for="artist_name">Nom :</label>
                    <input type="text" id="artist_name" name="artist_name" required>
                </div>

                <div>
                    <label for="artist_country">Pays :</label>
                    <input type="text"  id="artist_country" name="artist_country" required>
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
            if (verifArtist($bdd, $artist_name)){
                ?>
                <div class = "error_add">
                    <p>L'artiste est déjà enregistré !</p>
                </div>
                <?php
            } else {
                #On ajoute l'artiste a la BDD
                addArtist($bdd, $artist_name, $artist_country);
                ?>
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

        <div class = "formulaire">
            <form action="ajoutDonnees.php" method="post">
                <p>Ajout d'une musique :</p>

                <div>
                    <label for="artist_name">Artiste :</label>

                    <select name="artist_name" id="artist_name" required>
                        <?php 
                            // On prends tout le nom des artistes dans la base de données :
                            $req = $bdd->query('SELECT Artist.name 
									            FROM Artist');

                            while ($donnees = $req->fetchArray()){
                                echo "<option>".  $donnees['name'] . "</option><br>";
                            }
                        ?>
                    </select>
                </div>

                <div>
                    <label for="music_name">Nom de la musique :</label>
                    <input type="text"  id="music_name" name="music_name" required>
                </div>

                <div>
                    <label for="music_type">Type de musique :</label>

                    <select name="music_type" id="music_type" required>

                        <option value="rock">Rock</option>
                        <option value="pop">Pop</option>
                        <option value="jazz">Jazz</option>
                        <option value="rap">Rap</option>
                        <option value="folk">Folk</option>
                        <option value="punk">Punk</option>
                        <option value="hiphop">Hip-Hop</option>
                        <option value="rnb">RNB</option>
                        <option value="electro">Electro</option>
                    </select>
                </div>
                
                <div>
                    <label for="music_like">Nombre de like :</label>
                    <input type="number"  id="music_like" name="music_like" required>
                </div>

                <div>
                    <label for="music_dislike">Nombre de dislike :</label>
                    <input type="number"  id="music_dislike" name="music_dislike" required>
                </div>

                <div>
                    <label for="music_time">Durée (seconde) :</label>
                    <input type="text"  id="music_time" name="music_time" required>
                </div>

                <div>
                    <label for="music_url">Url (youtube.watch) :</label>
                    <input type="text"  id="music_url" name="music_url" required>
                </div>

                <div>
                    <label for="music_thumbnail">Miniature (lien image) :</label>
                    <input type="text"  id="music_thumbnail" name="music_thumbnail" required>
                </div>

                <div class="button">
                    <button type="submit">Ajouter la musique</button>
                </div>
            </form>
        </div>
        <?php
        if (isset($_POST['artist_name']) and isset($_POST['music_name']) and isset($_POST['music_type']) and isset($_POST['music_like']) and isset($_POST['music_dislike']) and isset($_POST['music_time']) and isset($_POST['music_url']) and isset($_POST['music_thumbnail'])){ #Si on a les données
            $artist_name = $_POST['artist_name'];
            $music_name = $_POST['music_name'];
            $music_type = $_POST['music_type'];
            $music_like = $_POST['music_like'];
            $music_dislike = $_POST['music_dislike'];
            $music_time = $_POST['music_time'];
            $music_url = $_POST['music_url'];
            $music_thumbnail = $_POST['music_thumbnail'];

            #On vérifie si il y a déjà l'artiste dans la BDD
            if (verifMusic($bdd, $music_name)){
                ?>
                    <div class = "error_add">
                        <p>La musique est déjà enregistré !</p>
                    </div>
                <?php
            } else {
                addMusic($bdd,$artist_name,$music_name,$music_type,$music_like,$music_dislike,$music_time,$music_url,$music_thumbnail);

                ?>
                <div class = "add_valid">
                    <p>Musique ajoutée !</p>
                </div>
                <?php
            }
        }  ?>
    </body>
</html>
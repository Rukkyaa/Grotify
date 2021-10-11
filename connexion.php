<?php
session_start();
setcookie('pseudo', 'Rukkyaa', time() + 365*24*3600, null, null, false, true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Grotify</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="connexionPageStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Kenia&display=swap" rel="stylesheet">
</head>

<body>
    <?php $bdd = new SQLite3('db_grotify.db')?>

    <div class = "formulaire">
        <form action="connexion.php" method="post">
            <p>Formulaire de connexion:</p>

            <div>
                <label for="email">Email :</label>
                <input type="email"  id="email" name="email" required>
            </div>

            <div>
                <label for="password">Password :</label>
                <input type="password"  id="password" name="password" required >
            </div>

            <div class="button">
              <button type="submit">Vous inscrire</button>
            </div>
        </form>
    </div>

    <div class = "home">
        <img src="images/icon_home.png">
        <a href="index.php">Accueil</a>
    </div>

    <?php 
        
        if (isset($_POST['password']) and isset($_POST['email'])){#si on a les données
            $password = $_POST['password'];
            $email = $_POST['email'];
            
            #On vérifie si il y a déjà l'email dans la BDD
            $stmt = $bdd->prepare("SELECT * FROM User WHERE email = :email");
            $stmt->bindValue(":email", $email, SQLITE3_TEXT);
            $req = $stmt->execute();
            
            $donnees = $req -> fetchArray();

            if ($password == $donnees['password']){
                ?>
                <div class = "connexion_valid">
                    <p>Connexion réussie</p>
                </div>
                <?php
            } else {?>
                <div class = "error_connexion">
                    <p>Erreur dans la connexion !</p>
                </div>

                <?php
            }
        } 

        
    ?>
</body>

</html>
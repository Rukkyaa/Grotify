<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Grotify</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="connexionPageStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Kenia&display=swap" rel="stylesheet">
    <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
</head>

<body>
    <?php
        include('header.php');
        $bdd = new SQLite3('db_grotify.db');
    ?>

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

            <p>Pas de compte ? <a href = "inscription.php">Inscrivez vous ici !</a></p>

        </form>
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
                $_SESSION['name'] = $donnees['first_name'];
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
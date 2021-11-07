<?php
session_start(); #Permet d'accèder aux variables $_SESSION
$bdd = new SQLite3('db_grotify.db'); #Permet d'accèder à la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page de connexion</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./styles/connexionPageStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Kenia&display=swap" rel="stylesheet">
    <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
</head>

<body>

    <?php include ('header.php');?>  <!-- Inclusion du header dans la page -->

    <!-- Formulaire pour que l'utilisateur se connecte -->
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
              <button type="submit">Se connecter</button>
            </div>

            <p>Pas de compte ? <a href = "inscription.php">Inscrivez vous ici !</a></p>

        </form>
    </div>

    <?php 
        #Partie pour connecter l'utilisateur au site
        if (isset($_POST['password']) and isset($_POST['email'])){ #Si on a les données
            #On stock les réponses du formulaire dans des variables
            $password = $_POST['password'];
            $email = $_POST['email'];
            
            #On vérifie si il y a déjà l'email dans la BDD
            $stmt = $bdd->prepare("SELECT * FROM User WHERE email = :email");
            $stmt->bindValue(":email", $email, SQLITE3_TEXT);
            $req = $stmt->execute();
            
            $donnees = $req -> fetchArray();

            if ($password == $donnees['password']){
                $_SESSION['name'] = $donnees['first_name'];
                $_SESSION['email'] = $donnees['email'];
                $_SESSION['user_id'] = $donnees['user_id'];
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
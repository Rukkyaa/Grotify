<?php
setcookie('pseudo', 'Rukkyaa', time() + 365*24*3600, null, null, false, true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Grotify</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/inscriptionPageStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Kenia&display=swap" rel="stylesheet">
    <link rel = "icon" type = "image/jpg" sizes="16x16" href = "images/icon.jpg">
</head>

<body>
    <?php $bdd = new SQLite3('db_grotify.db')?>

    <div class = "formulaire">
        <form action="inscription.php" method="post">
            <p>Formulaire d'inscription:</p>

            <div>
                <label for="first_name">Prénom :</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div>
                <label for="last_name">Nom :</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div>
                <label for="password">Password :</label>
                <input type="password"  id="password" name="password" required >
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email"  id="email" name="email" required>
            </div>

            <div class="button">
              <button type="submit">Vous inscrire</button>
            </div>

            <p>Déjà un compte ? <a href = "connexion.php">Connectez vous ici !</a></p>
        </form>
    </div>

    <div class = "logo">
        <a href="accueil.php"><img src="images/logo.jpg"></a>
    </div>

    <?php 
        
        if (isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['password']) and isset($_POST['email'])){#si on a les données
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            
            #On vérifie si il y a déjà l'email dans la BDD
            $stmt = $bdd->prepare("SELECT email FROM User WHERE email = :email");
            $stmt->bindValue(":email", $email, SQLITE3_TEXT);
            $req = $stmt->execute();
            
            $donnees = $req -> fetchArray();

            if ($email == $donnees['email']){
                ?>
                <div class = "error_inscription">
                    <p>L'email est déjà utilisé !</p>
                </div>
                <?php
            } else {
                #On ajoute l'utilisateur a la BDD
                $stmt = $bdd->prepare("INSERT INTO User
                                        (first_name, last_name, password, email)
                                        VALUES
                                        (:first_name, :last_name, :password, :email)");
                $stmt -> bindValue(":first_name", $first_name, SQLITE3_TEXT);
                $stmt -> bindValue(":last_name", $last_name, SQLITE3_TEXT);
                $stmt -> bindValue(":password", $password, SQLITE3_TEXT );
                $stmt -> bindValue(":email", $email, SQLITE3_TEXT);
                $stmt -> execute();?>

                <div class = "inscription_valid">
                    <p>Votre inscription est validé !</p>
                </div>

                <?php
            }
        } 

        
    ?>
</body>

</html>
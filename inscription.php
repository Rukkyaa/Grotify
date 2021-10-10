<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Grotify</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="loginPageStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Kenia&display=swap" rel="stylesheet">
</head>

<body>
    <div class = "formulaire">
        <form action="inscription.php" method="get">
            <p>Formulaire d'inscription:</p>

            <div>
                <label for="first_name">Prénom :</label>
                <input type="text" id="first_name" name="first_name">
            </div>
            <div>
                <label for="last_name">Nom :</label>
                <input type="text" id="last_name" name="name">
            </div>
            <div>
                <label for="password">Password :</label>
                <input type="password"  id="password" name="password">
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email"  id="email" name="email">
            </div>

            <div class="button">
              <button type="submit">Vous inscrire</button>
            </div>
        </form>
    </div>
</body>

</html>
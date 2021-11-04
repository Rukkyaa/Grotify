<?php
$bddFunction = new SQLite3('db_grotify.db');

#Fonction permettant de transformer les liens youtube watch en youtube embed pour les iframes
function urlToEmbed($urlYTB){
    $urlYTB = str_replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/", $urlYTB);
    $urlYTB .= "?autoplay=1&mute=1";
    return $urlYTB;
}

#Fonction permettant de vérifier si un artiste est déjà dans la base de données
function verifArtist($bdd, $artistName){
    $stmt = $bdd->prepare("SELECT name 
                            FROM Artist 
                            WHERE name = :artist_name");

    $stmt->bindValue(":artist_name", $artistName, SQLITE3_TEXT);
    $req = $stmt->execute();
    $donnees = $req -> fetchArray();

    if ($artistName == $donnees['name']){
        return TRUE;
    } else {
        return FALSE;
    }
}

#Fonction permettant d'ajouter un artiste a la base de données
function addArtist($bdd, $artistName, $artistCountry){
    $stmt = $bdd->prepare("INSERT INTO Artist
                            (name, country, numberOfSong, numberOfViews)
                            VALUES
                            (:artistName, :artistCountry, 0, 0)");

    $stmt -> bindValue(":artistName", $artistName, SQLITE3_TEXT);
    $stmt -> bindValue(":artistCountry", $artistCountry, SQLITE3_TEXT);
    $stmt -> execute();
}

#Fonction permettant de vérifier si une musique est déjà dans la base de données
function verifMusic($bdd,$music_name){
    $stmt = $bdd->prepare("SELECT Music.music_name
                            FROM Music 
                            WHERE Music.music_name = :music_name");

    $stmt->bindValue(":music_name", $music_name, SQLITE3_TEXT);
    $req = $stmt->execute();
    $donnees = $req -> fetchArray();
    if ($music_name == $donnees['music_name']){
        return TRUE;
    } else {
        return FALSE;
    }
}

#Fonction permettant d'avoir l'id de l'artiste en donnant son nom
function getArtistId($bdd, $artist_name){
    $stmt = $bdd->prepare("SELECT Artist.artist_id
                            FROM Artist 
                            WHERE Artist.name = :artist_name");

    $stmt->bindValue(":artist_name", $artist_name, SQLITE3_TEXT);
    $req = $stmt->execute();
    $donnees = $req -> fetchArray();

    return $donnees['artist_id'];
}

#Fonction permettant d'ajouter une musique a la base de données
function addMusic($bdd,$artist_name,$music_name,$music_type,$music_like,$music_dislike,$music_time,$music_url,$music_thumbnail){

    $stmt = $bdd->prepare("INSERT INTO Music
                            (artist_id, music_name, music_type, music_like, music_dislike, music_time, music_url, music_thumbnail)
                            VALUES
                            (:artist_id, :music_name, :music_type, :music_like, :music_dislike, :music_time, :music_url, :music_thumbnail)");

    $stmt -> bindValue(":artist_id", getArtistId($bdd, $artist_name), SQLITE3_TEXT);
    $stmt -> bindValue(":music_name", $music_name, SQLITE3_TEXT);
    $stmt -> bindValue(":music_type", $music_type, SQLITE3_TEXT);
    $stmt -> bindValue(":music_like", $music_like, SQLITE3_TEXT);
    $stmt -> bindValue(":music_dislike", $music_dislike, SQLITE3_TEXT);
    $stmt -> bindValue(":music_time", getSecond($music_time), SQLITE3_TEXT);
    $stmt -> bindValue(":music_url", urlToEmbed($music_url), SQLITE3_TEXT);
    $stmt -> bindValue(":music_thumbnail", $music_thumbnail, SQLITE3_TEXT);
    $stmt -> execute();
}

#Fonction permettant d'avoir la liste des musiques d'après leur type
function getMusicType($bdd, $type){
    $stmt = $bdd -> prepare("SELECT *
                                FROM Music
                                WHERE Music.music_type = :type");
    $stmt -> bindValue(":type", $type, SQLITE3_TEXT);
    $req = $stmt -> execute ();
    return $req;
}

#Fonction qui convertit les minutes en secondes
function getSecond($time){
    $numberOfSecond = 0;
    $timeToConvert = explode(':', $time);
    $numberOfSecond += $timeToConvert[1];
    $numberOfSecond += ($timeToConvert[0]*60);
    return $numberOfSecond;
}

#Fonction qui retourne l'id en donnant le lien de son image
function getNameByImgUrl($bdd, $imgUrl){
    $stmt = $bdd -> prepare("SELECT *
                                FROM Music
                                WHERE Music.music_thumbnail = :thumbnail");
    $stmt -> bindValue(":thumbnail", $imgUrl, SQLITE3_TEXT);
    $req = $stmt -> execute ();
    $donnees = $req -> fetchArray();
    return $donnees['music_id'];
}

#Fonction qui retourne l'url en donnant son id
function getUrlById($bdd, $id){
    $stmt = $bdd -> prepare("SELECT *
                                FROM Music
                                WHERE Music.music_id = :music_id");
    $stmt -> bindValue(":music_id", $id, SQLITE3_TEXT);
    $req = $stmt -> execute ();
    $donnees = $req -> fetchArray();
    return $donnees['music_url'];
}

#Fonction qui donne les informations de la musique en ayant son id
function getInformationById($bdd, $id){
    $stmt = $bdd -> prepare("SELECT *
                                FROM Music
                                WHERE Music.music_id = :music_id");
    $stmt -> bindValue(":music_id", $id, SQLITE3_TEXT);
    $req = $stmt -> execute ();
    $donnees = $req -> fetchArray();
    return $donnees;
}

#Fonction qui convertit les secondes en format hh/mm/ss :
function getTimeBySecond($seconde){
    $minute = 0;

    while ($seconde >= 60){
        $minute += 1;
        $seconde -= 60;
    }

    if ($seconde <10){
        $second = "0";
        $second .= strval($seconde);
        $seconde = $second;
    }
    return "$minute:$seconde";
}

#Fonction qui permet de voir si un user a déjà liké une musique :
function getUserLikeByMusique($bdd, $userid, $musicid){
    $stmt = $bdd -> prepare("SELECT *
                                FROM UserLikes
                                INNER JOIN User on User.user_id = UserLikes.user_id
                                INNER JOIN Music on Music.music_id = UserLikes.music_id
                                WHERE User.user_id = :userId AND Music.music_id = :musicId");
    $stmt -> bindValue(":userId", $userid, SQLITE3_TEXT);
    $stmt -> bindValue(":musicId", $musicid, SQLITE3_TEXT);
    $req = $stmt -> execute ();
    $donnees = $req -> fetchArray();

    if ($donnees == NULL){
        return FALSE;
    } else {
        return TRUE;
    }
}

#Fonction qui met le like d'une personne sur une musique :
function like($bdd, $userid, $musicid){
    #Rajoute un like dans la table User :
    $stmt = $bdd -> prepare("UPDATE User
                                SET numberOfLikes = numberOfLikes + 1
                                WHERE User.user_id = :userid");

    $stmt -> bindValue(":userid", $userid, SQLITE3_TEXT);
    $stmt -> execute();

    #Rajoute un like dans la table musique
    $stmt = $bdd -> prepare("UPDATE Music
                                SET music_like = music_like + 1
                                WHERE Music.music_id = :musicid");

    $stmt -> bindValue(":musicid", $musicid, SQLITE3_TEXT);
    $stmt -> execute();

    #Mets le nouveau like dans la table de like
    $stmt = $bdd->prepare("INSERT INTO UserLikes
                            (user_id, music_id)
                            VALUES
                            (:user_id, :music_id)");

    $stmt -> bindValue(":user_id", $userid, SQLITE3_TEXT);
    $stmt -> bindValue(":music_id", $musicid, SQLITE3_TEXT);
    $stmt -> execute();
}

#Fonction qui met le like d'une personne sur une musique :
function dislike($bdd, $userid, $musicid){
    #Enlève un like dans la table User :
    $stmt = $bdd -> prepare("UPDATE User
                                SET numberOfLikes = numberOfLikes - 1
                                WHERE User.user_id = :userid");

    $stmt -> bindValue(":userid", $userid, SQLITE3_TEXT);
    $stmt -> execute();

    #Enlève un like dans la table musique
    $stmt = $bdd -> prepare("UPDATE Music
                                SET music_like = music_like - 1
                                WHERE Music.music_id = :musicid");

    $stmt -> bindValue(":musicid", $musicid, SQLITE3_TEXT);
    $stmt -> execute();

    #Enlève le like dans la table like
    $stmt = $bdd->prepare("DELETE FROM UserLikes
                            WHERE UserLikes.music_id = :musicid AND UserLikes.user_id = :userid");

    $stmt -> bindValue(":userid", $userid, SQLITE3_TEXT);
    $stmt -> bindValue(":musicid", $musicid, SQLITE3_TEXT);
    $stmt -> execute();
}

#Fonction qui retourne les ID des likes d'un utilisateur:
function getAllLikesFromUser($bdd, $userId){
    $stmt = $bdd -> prepare("SELECT Music.music_id
                                FROM UserLikes
                                INNER JOIN Music ON Music.music_id = UserLikes.music_id 
                                INNER JOIN User ON User.user_id = UserLikes.user_id
                                WHERE User.user_id = :userId");

    $stmt -> bindValue(":userId", $userId, SQLITE3_TEXT);
    $req = $stmt -> execute();
    return $req;
}
?>
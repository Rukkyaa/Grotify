<?php
#Fonction permettant de transformer les liens youtube watch en youtube embed pour les iframes
function urlToEmbed($urlYTB){
    $urlYTB = str_replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/", $urlYTB);
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
    $stmt -> bindValue(":music_time", $music_time, SQLITE3_TEXT);
    $stmt -> bindValue(":music_url", urlToEmbed($music_url), SQLITE3_TEXT);
    $stmt -> bindValue(":music_thumbnail", $music_thumbnail, SQLITE3_TEXT);
    $stmt -> execute();
}

?>
<?php
// Affiche le contenu du formulaire
// var_dump($_POST);

// Import des scripts externes
include_once 'inc/globals.php';

// Teste si le couple login/password est correct
try {
    // Connexion à la BDD
    $conn = new PDO(
        'mysql:host='.HOST.';dbname='.DATA.';charset=utf8',
        USER,
        PASS,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        )
    );

    // Prépare la requête
    $sql = '';

} catch(PDOException $err){
    header('location:login.php?code=2');
}
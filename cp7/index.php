<?php
// Constante nom application
// define('APP_NAME', 'Live Stream');
const APP_NAME = "Live Stream";
// Ecart en jours
$today = strtotime("now");
// $today = strtotime(date("Y-m-d"));
$start = strtotime("2022-01-13");
$gap = floor(($today - $start) / 60 / 60 / 24);
// Tableau des membres de l'équipe
$crew = array(
    array(
        "fname" => "Maeliss",
        "age" => 20,
        "sexe" => "F",
        "hobbies" => array("Codage", "Manga")
    ),
    array(
        "fname" => "Mourad",
        "age" => 37,
        "sexe" => "M",
        "hobbies" => array("Conduite")
    ),
    array(
        "fname" => "Fayçal",
        "age" => 21,
        "sexe" => "M",
        "hobbies" => array("Crypto monnaie")
    ),
    array(
        "fname" => "Ilyes",
        "age" => 19,
        "sexe" => "M",
        "hobbies" => array("1664", "86")
    ),
    array(
        "fname" => "Mohamed",
        "age" => 25,
        "sexe" => "M",
        "hobbies" => array("Boxe", "Foot")
    ),
    array(
        "fname" => "Ahmad",
        "age" => 26,
        "sexe" => "M",
        "hobbies" => array("Famille")
    ),
    array(
        "fname" => "Joëlle",
        "age" => 20,
        "sexe" => "F",
        "hobbies" => array("Sport", "Voyages")
    ),
    array(
        "fname" => "Yann",
        "age" => 56,
        "sexe" => "M",
        "hobbies" => array("3D", "Voyages")
    ),
    array(
        "fname" => "Aymane",
        "age" => 24,
        "sexe" => "M",
        "hobbies" => array("Nourriture")
    ),
    array(
        "fname" => "Inas",
        "age" => 20,
        "sexe" => "F",
        "hobbies" => array("Basket", "Mode")
    ),
    array(
        "fname" => "Sofiane",
        "age" => 24,
        "sexe" => "M",
        "hobbies" => array("Cinéma", "Musique")
    ),
    array(
        "fname" => "Jonathan",
        "age" => 36,
        "sexe" => "M",
        "hobbies" => array("Sport", "Jardinage")
    ),
    array(
        "fname" => "Iheb",
        "age" => 31,
        "sexe" => "M",
        "hobbies" => array("Foot", "Bachata")
    ),
    array(
        "fname" => "Raphaële",
        "age" => 20,
        "sexe" => "F",
        "hobbies" => array("Couture", "Foot")
    ),
    array(
        "fname" => "Sadou",
        "age" => 30,
        "sexe" => "M",
        "hobbies" => array("Politique", "Spiritualisme")
    ),
    array(
        "fname" => "Lesly",
        "age" => 55,
        "sexe" => "M",
        "hobbies" => array("No sport", "Bouffe")
    )
);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> : VOD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body class="container">
    <div class="jumbotron">
        <h1 class="display-4"><?php echo APP_NAME; ?></h1>
        <p class="lead">Bienvenue sur la plateforme <?php echo APP_NAME; ?>. Ce site a été mis en ligne par la Garamont Coders Crew il y a <?php echo $gap; ?> jours. Elle permet de louer des films full HD en-ligne ou via notre application mobile.</p>
        <hr>
        <a href="register.php" class="btn btn-info">Inscription</a>
        <a href="login.php" class="btn btn-primary">Connexion</a>
    </div>
</body>

</html>
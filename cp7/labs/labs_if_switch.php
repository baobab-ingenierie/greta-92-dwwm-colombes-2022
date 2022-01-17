<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>TP : Structures de contrôle</h1>
    <h2>Exercice 1</h2>
    <?php
    $sexe = "F";
    if ($sexe == "F") {
        echo "<p>Bonjour madame</p>";
    } else {
        echo "<p>Bonjour monsieur</p>";
    }
    // Avec un ternaire
    echo ($sexe == "F") ? "<p>Bonjour madame</p>" : "<p>Bonjour monsieur</p>";
    ?>
    <h2>Exercice 2</h2>
    <?php
    $budget = 1234.56;
    $achats = 1357.99;
    echo ($budget < $achats) ? "<p>Le budget ne couvre pas l'achat</p>" : "<p>Le budget couvre l'achat</p>";
    ?>
    <h2>Exercice 3</h2>
    <?php
    // $h = 16;
    $l = "fr"; // "en"
    $h = (int) date('H');
    switch (true) {
        case $h <= 12:
            // echo "Bonjour !";
            echo ($l == "en") ? "<p>Good morning!" : "<p>Bonjour !";
            break;
        case $h <= 18:
            // echo "Bonne après-midi !";
            echo ($l == "en") ? "<p>Good afternoon!" : "<p>Bonne après-midi !";
            break;
        default:
            // echo "Bonsoir !";
            echo ($l == "en") ? "<p>Good night!" : "<p>Bonsoir !";
    }
    ?>
</body>

</html>
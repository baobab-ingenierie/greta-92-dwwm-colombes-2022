<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>TP : Tableaux 1</h1>
    <h2>Exercice 1</h2>
    <?php $personnes = array(
        'Ryan' => 16,
        'Lulu' => 19,
        'Sacha' => 66
    );
    echo "<p>Age de Lulu : " . $personnes["Lulu"];
    ?>
    <h2>Exercice 2</h2>
    <?php
    $cocktails = array('Mojito', 'Long Island Iced Tea', 'Gin Fizz', 'Moscow mule');
    echo '<p>Deuxième cocktail : ' . $cocktails[1];
    ?>
    <h2>Exercice 3</h2>
    <?php
    $pays_population = array(
        'France' => 67595000,
        'Suede' => 9998000,
        'Suisse' => 8417000,
        'Kosovo' => 1820631,
        'Malte' => 434403,
        'Mexique' => 122273500,
        'Allemagne' => 82800000
    );
    // echo "Nombre de pays : " . sizeof($pays_population);
    echo "Nombre de pays : " . count($pays_population);
    ?>
</body>

</html>
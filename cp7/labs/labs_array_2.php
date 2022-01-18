<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>TP : Tableaux 2</h1>
    <h2>Exercice 1</h2>
    <?php
    $countries = array(
        "France" => "Paris",
        "Allemagne" => "Berlin",
        "Italie" => "Rome",
        "Maroc" => "Rabat",
        "RP Chine" => "Pékin"
    );
    $html = "<ul>";
    foreach ($countries as $key => $val) {
        $html .= "<li><strong>$key</strong> : $val</li>";
    }
    $html .= "</ul>";
    echo $html;
    ?>
    <h2>Exercice 2</h2>
    <h3>Solution 1</h3>
    <?php
    // $tab2 = array();
    $tab2 = [];
    for ($i = 0; $i < 10; $i++) {
        array_push($tab2, rand(0, 50));
        echo ($tab2[$i] === 25) ? "<p>Le tableau contient la valeur 25 à la position $i" : "";
    }
    var_dump($tab2);
    ?>
    <h3>Solution 2</h3>
    <?php
    $tab1 = array(
        rand(0, 50),
        rand(0, 50),
        rand(0, 50),
        rand(0, 50),
        rand(0, 50),
        rand(0, 50),
        rand(0, 50),
        rand(0, 50),
        rand(0, 50),
        rand(0, 50)
    );
    echo (in_array(25, $tab1)) ? "<p>Le tableau contient la valeur 25 à la position " . array_search(25, $tab1) : "";
    var_dump($tab1);
    ?>
    <h2>Exercice 3</h2>
    <?php
    $tab = [];
    $tab1 = [];
    $tab2 = [];
    for ($i = 0; $i < 10; $i++) {
        array_push($tab, rand(0, 100));
        ($tab[$i] < 50) ? array_push($tab1, $tab[$i]) : array_push($tab2, $tab[$i]);
    }
    var_dump($tab);
    var_dump($tab1);
    var_dump($tab2);
    ?>
    <h2>Exercice 4</h2>
    <?php
    $pays_pop = array(
        'France' => 67595000,
        'Suede' => 9998000,
        'Suisse' => 8417000,
        'Kosovo' => 1820631,
        'Malte' => 434403,
        'Mexique' => 122273500,
        'Allemagne' => 82800000
    );

    // for ($i = 0; $i < count($pays_pop); $i++) {
    //     if ($pays_pop[$i] >= 20000000) {
    //         echo "<p>" . $pays_pop[$i];
    //     }
    // }

    foreach ($pays_pop as $key => $val) {
        echo ($val >= 20000000) ? "<p>$key" : "";
    }
    ?>
</body>

</html>
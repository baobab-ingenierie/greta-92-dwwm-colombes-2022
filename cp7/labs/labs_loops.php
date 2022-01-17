<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>TP : Boucles</h1>
    <h2>Exercice 1</h2>
    <?php
    $html = "";
    for ($i = 0; $i < 6; $i++) {
        $html .= "<p>";
        for ($j = 0; $j < $i; $j++) {
            // $html = $html . $i;
            $html .= $i;
        }
    }
    echo $html;
    ?>
    <?php
    ?>
    <h2>Exercice 2</h2>
    <?php
    // $mlt = 5;
    $mlt = rand(1, 9);
    $html = "";
    for ($i = 1; $i < 11; $i++) {
        $html .= "<p>$mlt x $i = " . ($mlt * $i);
    }
    echo $html;
    ?>
    <h2>Exercice 3</h2>
    <?php
    $html = "<p>";
    $cp = 77000;
    while ($cp < 78000) {
        $html .= $cp++ . " ";
    }
    echo $html;
    ?>
</body>

</html>
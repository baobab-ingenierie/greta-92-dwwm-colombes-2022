<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>TP : Variables</h1>
    <h2>Exercice 1</h2>
    <?php
    ?>
    <h2>Exercice 2</h2>
    <?php
    $note_maths = 15;
    $note_francais = 12;
    $note_histoire_geo = 9;
    $moyenne = ($note_maths + $note_francais + $note_histoire_geo) / 3;
    echo "La moyenne est de $moyenne/20";
    ?>
    <h2>Exercice 3</h2>
    <?php
    $prix_ht = 50;
    $tva = 0.2; //20%
    $prix_ttc = $prix_ht * (1 + $tva);
    echo "Le prix TTC est de $prix_ttc EUR";
    ?>
</body>

</html>
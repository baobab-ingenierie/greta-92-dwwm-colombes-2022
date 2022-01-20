<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>TP : Fonctions</h1>

    <h2>Exercice 1</h2>
    <?php
    /**
     * Cette fonction renvoie un prix TTC en ayant en entrée
     * un prix HT et un taux de TVA (20%, 10% et 5.5%)
     * @param float $ht prix HT
     * @param float $taux taux de TVA (20%, 10% et 5.5%)
     * @return float prix TTC
     */
    function ttc(float $ht, float $taux): float
    {
        // Teste les règles de gestion
        if ($ht < 0) {
            // R1 : prix HT doit être positif
            trigger_error('Le prix HT doit être positif.', E_USER_WARNING);
        } elseif ($taux !== .2 && $taux !== .1 && $taux !== .055) {
            // R2 : taux doit être égal ) 0.2, 0.1 ou 0.055
            trigger_error('Le taux doit être 0.2, 0.1 ou 0.055.', E_USER_WARNING);
        } else {
            return $ht * (1 + $taux);
        }
    }

    // Tests
    echo '<p>Test 1 : ' . ttc(100, .2);
    // echo '<p>Test 2 : ' . ttc(100, .186);
    // echo '<p>Test 3 : ' . ttc(-100, 'toto');
    ?>

    <h2>Exercice 2</h2>
    <?php
    /**
     * Fonction qui génère une table de multiplication à
     * partir d'un paramètre entier
     * @param int $nb nombre entier
     * @return string élément HTML de type TABLE
     */
    function multiplication(int $nb): string
    {
        $html = '<table border="1">';
        for ($row = 1; $row < $nb + 1; $row++) {
            $html .= '<tr>';
            for ($col = 1; $col < $nb + 1; $col++) {
                $html .= '<td>' . ($row * $col) . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';
        return $html;
    }

    // Tests
    echo multiplication(10);
    echo multiplication(25);
    ?>

    <h2>Exercice 3</h2>
    <?php
    /**
     * Fonction qui renvoie la moyenne des nombres passés en paramètres 
     * sous l'une des formes suivante :
     * - tableau : array(1, 2, 3, 4, 5) = 1 paramètre de type array
     * - liste de nombres : 1, 2, 3, 4, 5 = n paramètres de type float
     * @return float moyenne des nombres uniquement
     */
    function average(): float
    {
        return 0.0;
    }
    ?>
</body>

</html>
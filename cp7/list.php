<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body class="container">
    <!-- <h1>Liste</h1> -->
    <?php
    // Teste l'existence des variables t (pour nom de la table) et
    // k (pour nom de la colonne PK)
    if (isset($_GET['t']) && !empty($_GET['t'])) {
        $_GET['t'] = htmlspecialchars($_GET['t']);
    } else {
        $_GET['t'] = '';
    }

    if (isset($_GET['k']) && !empty($_GET['k'])) {
        $_GET['k'] = htmlspecialchars($_GET['k']);
    } else {
        $_GET['k'] = '';
    }

    if ($_GET['t'] === '' || $_GET['k'] === '') {
        echo '<p class="alert alert-danger">Table ou colonne PK non définie.</p>';
        exit();
    }

    // Si table et PK indiqués
    echo '<h1>' . $_GET['t'] . '</h1>';

    echo '<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
        <li class="breadcrumb-item"><a href="bo.php">Back-office</a></li>
        <li class="breadcrumb-item active" aria-current="page">Liste</li>
        </ol>
    </nav>';

    try {
        include_once 'inc/globals.php';
        include_once 'class/database.class.php';
        $myDb = new Database('mysql', HOST, PORT, DATA, USER, PASS);

        $_GET['p'] = !isset($_GET['p']) ? 1 : $_GET['p'];
        $_GET['nb'] = !isset($_GET['nb']) ? 7 : $_GET['nb'];
        $start = ($_GET['p'] - 1) * $_GET['nb'];
        echo $myDb->makeTable(
            'SELECT * FROM ' . $_GET['t'] . ' LIMIT ' . $start . ',' . $_GET['nb'],
            array(),
            $_GET
        );

        // Crée la pagination
        $html = '<nav><ul class="pagination flex-wrap justify-content-center">';

        // Calcule la paginations nb total de lignes 
        $pgs = count($myDb->getData('SELECT * FROM ' . $_GET['t']));
        $pgs = ceil($pgs / $_GET['nb']);
        for ($i = 1; $i <= $pgs; $i++) {
            $_GET['p'] = $i;
            $qry = http_build_query($_GET);
            $html .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?' . $qry  . '">' . $i . '</a></li>';
        }

        $html .= '</ul></nav>';
        echo $html;
    } catch (PDOException $err) {
        echo '<p class="alert alert-danger">' . $err->getMessage() . '</p>';
    }
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edition</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body class="container">
    <?php
    // Tests
    $t = null;
    $k = null;
    $v = null;

    if (isset($_GET['t']) && !empty($_GET['t'])) {
        $t = htmlspecialchars($_GET['t']);
    }

    if (isset($_GET['k']) && !empty($_GET['k'])) {
        $k = htmlspecialchars($_GET['k']);
    }

    if (isset($_GET['v'])) {
        $v = htmlspecialchars($_GET['v']);
    }

    if ($t && $k) {
        // Fabrique le formulaire
        include_once 'inc/globals.php';
        include_once 'class/database.class.php';
        include_once 'class/model.class.php';
        $myTable = new Model('mysql', HOST, PORT, DATA, USER, PASS, 'user');
        echo $myTable->makeForm($t, $k, $v);
    } else {
        echo '<p class="alert alert-danger">Table ou colonne PK ou valeur colonne PK non définie.</p>';
    }
    ?>
</body>

</html>
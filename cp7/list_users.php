<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Stream - Liste des utilisateurs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body class="container">
    <h1>Liste des utilisateurs</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Library</li>
        </ol>
    </nav>

    <?php
    // Inclusion params de connexion
    include_once 'inc/globals.php';

    // Génération du tableau HTML via requête SQL
    try {
        // Prépare et exécute la requête
        $conn = new PDO(
            sprintf('mysql:host=%s;dbname=%s;charset=utf8', HOST, DATA),
            USER,
            PASS,
            OPTIONS
        );

        $sql = 'SELECT u.user_id,
                    c.first_name,
                    u.role,
                    c.email,
                    c.active,
                    c.last_update
        FROM user u
        JOIN customer c
        ON c.customer_id = u.user_id
        ORDER BY last_update DESC';

        $res = $conn->prepare($sql);
        $res->execute();

        // Parcourt le dataset et l'affiche dans le tableau HTML
        $html = '<table class="table table-dark table-striped">';

        // Affiche les en-têtes
        $html .= '<thead>';
        $html .= '<tr>';
        for ($i = 0; $i < $res->columnCount(); $i++) {
            $meta = $res->getColumnMeta($i);
            $html .= '<th>' . $meta['name'] . '</th>';
        }
        $html .= '</tr>';
        $html .= '</thead>';

        // Affiche les data
        $html .= '<tbody>';
        while ($row = $res->fetch()) {
            $html .= '<tr>';
            foreach ($row as $val) {
                $html .= '<td>' . $val . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';

        unset($conn);
        echo $html;
    } catch (PDOException $err) {
        echo '<p class="alert alert-danger">' . $err->getMessage() . '</p>';
    }
    ?>
</body>

</html>
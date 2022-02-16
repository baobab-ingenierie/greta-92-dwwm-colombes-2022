<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back-office</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body class="container">
    <h1>Back-office</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Back-office</li>
        </ol>
    </nav>

    <section id="tables" class="d-flex flex-wrap justify-content-around">
        <?php
        include_once 'inc/globals.php';
        include_once 'class/database.class.php';

        $sql = 'SELECT t.table_name, 
                        t.table_type, 
                        t.table_rows, 
                        t.create_time,
                        c.column_name,
                        c.column_key
                FROM information_schema.tables t
                    JOIN information_schema.columns c
                        ON t.table_schema = c.table_schema
                        AND t.table_name = c.table_name
                WHERE t.table_schema = :schema
                AND c.column_key = :primary
                AND t.table_name NOT IN (SELECT table_name
						FROM information_schema.columns
						WHERE table_schema = :schema
						AND column_key = :primary
						GROUP BY table_schema, table_name
						HAVING COUNT(*) > 1)
                UNION
                SELECT t.table_name, 
                        t.table_type, 
                        t.table_rows, 
                        t.create_time,
                        null,
                        null
                FROM information_schema.tables t
                    JOIN information_schema.columns c
                        ON t.table_schema = c.table_schema
                        AND t.table_name = c.table_name
                WHERE t.table_schema = :schema
                AND t.table_type = :type
                ORDER BY table_name';

        $params = array(
            ':schema' => DATA,
            ':primary' => 'PRI',
            ':type' => 'VIEW'
        );

        $data = new Database('mysql', HOST, PORT, DATA, USER, PASS);
        $cards = $data->getData($sql, $params);
        // var_dump($cards);

        $html = '';
        foreach ($cards as $val) {
            $template = '<div class="card my-3" style="width: 18rem;">
            <img src="%s" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">%s</h5>
              <p class="card-text">%s</p>
              <a href="%s" class="btn btn-primary" style="%s">Plus de détails</a>
            </div>
            </div>';

            $src = $val['TABLE_TYPE'] === 'VIEW' ? 'pics/view.jpg' : 'pics/table.jpg';

            $h5 = strtoupper($val['TABLE_NAME']);

            if ($val['TABLE_TYPE'] === 'VIEW') {
                $p = 'Vue créée le ' . $val['CREATE_TIME'] . '.';
                $style = 'display:none;';
            } else {
                $p = 'Table créée le ' . $val['CREATE_TIME'] . ' contenant ' . $val['TABLE_ROWS'] . ' lignes.';
                $style = '';
            }

            $href = 'list.php?t=' . $val['TABLE_NAME'] . '&k=' . $val['COLUMN_NAME'];

            $html .= sprintf($template, $src, $h5, $p, $href, $style);
        }
        echo $html;
        ?>
    </section>
</body>

</html>
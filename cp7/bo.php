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

    <section id="tables">
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
                AND t.table_type = :type';

        $params = array(
            ':schema' => DATA,
            ':primary' => 'PRI',
            ':type' => 'VIEW'
        );

        $data = new Database('mysql', HOST, PORT, DATA, USER, PASS);
        $cards = $data->getData($sql, $params);
        var_dump($cards);
        ?>
    </section>
</body>

</html>
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
    <h1>Liste</h1>
    <?php
    include_once 'inc/globals.php';
    include_once 'class/database.class.php';
    $myDb = new Database('mysql', HOST, PORT, DATA, USER, PASS);
    echo $myDb->makeTable('SELECT * FROM customer');
    ?>
</body>

</html>
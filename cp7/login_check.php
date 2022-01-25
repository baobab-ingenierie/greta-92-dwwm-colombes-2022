<?php
// Affiche le contenu du formulaire pour test
// var_dump($_POST);

// Import des scripts externes
include_once 'inc/globals.php';

// 1. Vérifie et sécurise les données passées via POST
if (isset($_POST['login']) && !empty($_POST['login'])) {
    $login = htmlspecialchars($_POST['login']);
}
if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
}

// 2. Assigne les valeurs cryptées pour comparaison
$login = strtolower($login);
$password = hash('sha256', hash('md5', $password) . hash('sha1', $login));

// 3. Teste si le couple login/password est correct
try {
    // 3a. Connexion à la BDD
    $conn = new PDO(
        'mysql:host=' . HOST . ';dbname=' . DATA . ';charset=utf8',
        USER,
        PASS,
        // array(
        //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        // )
        OPTIONS
    );

    // 3b. Prépare la requête avec params anonymes
    $sql = 'SELECT c.active,
            c.first_name,
            c.customer_id,
            c.email,
            u.password,
            u.role,
            u.avatar
            FROM customer c 
            JOIN user u
            ON u.user_id = c.customer_id
            WHERE c.email = ?
            AND u.password = ?';
    $res = $conn->prepare($sql);

    // 3c. Exécute la requête avec ses paramètres
    $params = array($login, $password);
    $res->execute($params);

    // 3d. Si nb de ligne est 1 (login et password corrects)
    if ($res->rowCount() === 1) {
        // Démarre une session et stocke les variables dans $_SESSION
        session_start();
        $row = $res->fetch();
        $_SESSION['isauth'] = true;
        $_SESSION['fname'] = ucwords($row['first_name']);
        $_SESSION['userid'] = (int) $row['customer_id'];
        $_SESSION['role'] = (int) $row['role'];
        $_SESSION['avatar'] = $row['avatar'];
        var_dump($_SESSION);
        // Route vers index.php
        header('location:index.php?code=1');
    } else {
        header('location:index.php?code=0');
    }
} catch (PDOException $err) {
    header('location:index.php?code=2');
}

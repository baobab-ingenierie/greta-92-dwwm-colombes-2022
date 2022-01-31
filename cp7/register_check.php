<?php
var_dump($_POST);

/**
 * Slides 206 à 208 : PDO et PDOStatement
 * Slides 232 à 235 : requêtes préparées
 * 
 * A l'aide de la variable POST, insérer d'abord les données
 * dans la table CUSTOMER de la manière suivante :
 * - store_id = 1
 * - first_name = (formulaire)
 * - last_name = (formulaire)
 * - email = (formulaire)
 * - address_id = (formulaire)
 * - create_date = (date du jour = now())
 * Récupérer l'ID généré dans CUSTOMER
 * 
 * Insérer ensuite les données dans la table USER de la 
 * manière suivante :
 * - user_id = (même ID que dans CUSTOMER)
 * - password = (formulaire) avec algo de cryptage
 * - role = 1
 * 
 * Router vers la page index.php :
 * - si réussite avec le code 5 et un message 
 * - si échec avec le code 6 et un message 
 */

// 1. Récupère et assainit les variables du formulaire
foreach ($_POST as $key => $val) {
    if (isset($_POST[$key]) && !empty($_POST[$key])) {
        $$key = htmlspecialchars(trim($val)); // Variable dynamique
    } else {
        $$key = ''; // Variable dynamique
    }
}

// 2. Crypte le mot de passe
$email = strtolower($email);
$password = hash('sha256', hash('md5', $password) . hash('sha1', $email));

try {
    // 3. On se connecte à la BDD
    include_once 'inc/globals.php';
    $conn = new PDO(
        sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8', HOST, PORT, DATA),
        USER,
        PASS,
        OPTIONS
    );

    // 4. Teste si l'email existe déjà
    $sql = 'SELECT * FROM customer WHERE email=?';
    $params = array($email);
    $res = $conn->prepare($sql);
    $res->execute($params);
    if ($res->rowCount() === 0) {
        // 5. Crée le nouveau customer
        $sql = 'INSERT INTO customer(store_id, first_name, last_name, email, address_id) VALUES(:store_id, :first_name, :last_name, :email, :address_id)';
        $params = array(
            ':store_id' => 1,
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':address_id' => $address_id
        );
        $newcust = $conn->prepare($sql);
        $insert = $newcust->execute($params);

        // 6. Crée le user attaché au customer si bien créé
        if ($insert) {
            $sql = 'INSERT INTO user(user_id, password, role) VALUES(:user_id, :password, :role)';
            $params = array(
                ':user_id' => $conn->lastInsertId(),
                ':password' => $password,
                ':role' => 1
            );
            $newuser = $conn->prepare($sql);
            $newuser->execute($params);
            unset($conn);

            // 7. Message OK
            // header('location:index.php?code=5');
            echo 'Client et utilisateur créé avec succès.';
        } else {
            // header('location:index.php?code=6'); 
            echo 'L\'insertion du client a échouée.';
        }
    } else {
        // header('location:index.php?code=6');
        echo 'Ce mail existe déjà !';
    }
} catch (PDOException $err) {
    echo $err->getMessage();
}

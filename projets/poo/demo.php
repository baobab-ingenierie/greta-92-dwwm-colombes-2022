<?php

// Inclusion des paramètres de configuration
require 'config.inc.php';

// Inclusion de la classe MySQL
require 'Singleton.class.php';

/**
 * Requête SELECT basique
 */

// La requête est enregistrée dans une variable nommée $sql (request)
$sql = "SELECT * FROM contacts WHERE id = 5";

// La requête est exécutée en faisant appel à l'instance de connexion à MySQL via $stmt (statement)
$stmt = Singleton::getInstance()->query($sql);

// La variable $res (result) stocke un tableau contenant toutes les lignes de résultats
$res = $stmt->fetchAll();

// On affiche les résultats
var_dump($res);

/**
 * Requête préparée
 */

// La valeur de l'id est remplacé par le symbole ?
$req = "SELECT * FROM contacts WHERE id = ?";

// La requête est préparée sans les valeurs associées
$stmt = Singleton::getInstance()->prepare($req);

// La requête est exécutée avec le tableau [11] comme argument
// Le ? de la requête préparée est donc remplacé par la valeur 11
$stmt->execute([11]);

$res = $stmt->fetchAll();
var_dump($res);

/**
 * Requête préparée avec plusieurs paramètres
 */

// Les deux paramètres sont remplacés par des ?
$req = "SELECT * FROM contacts WHERE id = ? AND gender = ?";

// La requête est préparée
$stmt = Singleton::getInstance()->prepare($req);

// La requête est exécutée avec le tableau [7, 'Masculin'] comme argument
// Le premier ? sera remplacé par 7
// Le second ? sera remplacé par 'Masculin'
$stmt->execute([7, 'Masculin']);

$res = $stmt->fetchAll();
var_dump($res);

/**
 * Utilisation de la fonction bindValue() de PDO
 */

// Les paramètres sont identifiés via les marqueurs :id et :type
$req = "SELECT * FROM contacts WHERE id = :id AND gender = :gender";

// La requête est préparée
$stmt = Singleton::getInstance()->prepare($req);

// La valeur 4 est associée au marqueur id
$stmt->bindValue('id', 3);

// La valeur 'verbe' est associée au marqueur type
$stmt->bindValue('gender', 'Féminin');

$stmt->execute();
$res = $stmt->fetchAll();
var_dump($res);

/**
 * Utilisation de la fonction lastInsertId() de PDO
 */

$req = "INSERT INTO contacts SET fname = :fname, gender = :gender";
$stmt = Singleton::getInstance()->prepare($req);
$stmt->bindValue('fname', 'Lesly');
$stmt->bindValue('gender', 'Masculin');
$stmt->execute();

// On utilise lastInsertId() pour récupérer l'id d'enregistrement
echo "Insertion de l'enregistrement " . Singleton::getInstance()->lastInsertId();

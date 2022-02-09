<?php

// Imports
include_once '../class/database.class.php';
include_once '../class/model.class.php';

// Test 1 : Instanciation (connexion et requête SQL)
$db = new Database('mysql', 'localhost', 3306, 'colombes', 'root', 'root');

// Sans paramètre
var_dump($db->getData('SELECT * FROM customer'));

// Avec paramètres indexés
var_dump($db->getData('SELECT title FROM film WHERE title LIKE ? AND length BETWEEN ? AND ?', array('%love%', 30, 90)));

// Test 2 : Héritage
$myTable = new Model('mysql', 'localhost', 3306, 'colombes', 'root', 'root', 'country');
var_dump($myTable->getRows());

// Test 3 : insert
$myTable->setTable('city');
echo '<p>Statut ajout : ' . $myTable->insert(
    array(
        'city' => 'Saint-Cucul les Agassou',
        'country_id' => 34
    )
);

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

// test 4 : update
echo '<p>Statut mise à jour ' . $myTable->update(
    array(
        'city' => 'Pétaouchnok',
        'country_id' => 13
    ),
    'city_id',
    601
);

var_dump($myTable->getRow('city_id', 601));

// test 5 : delete manuel
echo '<p>Statut suppression : ' . $myTable->delete('city_id', array(602, 605));

// test 5 : delete automatique
var_dump($myTable->getRows(
    "SELECT city_id FROM city WHERE city LIKE '%cucul%'"
));

// echo '<p>Statut suppression : ' . $myTable->delete('city_id', $myTable->getRows(
//     'SELECT city_id FROM city WHERE city LIKE \'%cucul%\''
// ));

// test 6 : renvoi JSON
echo '<p>' . $db->getJSON('SELECT customer_id, first_name, last_name, email FROM customer WHERE customer_id>599');

// test 7 : renvoi tableau HTML
echo $db->makeTable('SELECT * FROM city');

echo $db->makeTable('SELECT c.first_name, c.email, u.password FROM customer c JOIN user u ON c.customer_id = u.user_id WHERE customer_id>599');

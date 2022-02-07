<?php
// Import
include_once '../class/animal.class.php';

// Test 1 : instanciation
echo '<h2>Instanciation</h2>';
$kitty = new Animal();
$kitty->name = 'Felix';
$kitty->name = '06 75 46 23 14';
$kitty->name = '1998-07-12';
// $kitty->weight = 5.2; -> génère une erreur car privé
var_dump($kitty);

// Test 2 : encapsulation
echo '<h2>Encapsulation</h2>';

$jerry = new Animal();

$jerry->name = 'Jerry';
$jerry->setDob('1956-05-03');

// $jerry->setFemale(-3.17159); -> 0 = false
// $jerry->setFemale('oui'); -> '' = false
// $jerry->setFemale(false);

// $jerry->setDob('1956-15-03'); -> setter avec argument incorrect

echo '<p>Date de naissance de Jerry : ' . $jerry->getDob(); // getter

echo '<p>Age de Jerry : ' . $jerry->getAge(); // getter readonly

var_dump($jerry);

// Test 3 : passage d'objet en paramètre
echo '<h2>Passage d\'objet en paramètre</h2>';

$bird = new Animal();
$bird->name = 'Titi';
$bird->setWeight(.5);
var_dump($bird);

$cat = new Animal();
$cat->name = 'Sylvestre';
$cat->setWeight(5.1);
var_dump($cat);

$cat->eat($bird);
var_dump($bird);
var_dump($cat);

// Test 3bis : constructeur
unset($bird); // détruit Titi

// Test 4 : constructeur
echo '<h2>Constructeur</h2>';

$cat2 = new Animal('Garfield', '', 6.5);
var_dump($cat2);

$cat3 = new Animal('Minette', '1998-07-12', 5.6, true);
var_dump($cat3);

// Test 5 : constante de classe
echo '<h2>Constante de classe</h2>';
echo '<p>Environnement : ' . Animal::ENV_GROUND;

<?php

include_once '../inc/functions.php';

/**
 * Teste la procédure SELECT_WEEK
 * PHP est faiblement typé :
 * STRING 'Hello' ou ''
 * INT 123 ou 0
 * FLOAT 3.14 ou 0.0
 * BOOL true ou false
 */
select_week();
select_week(true);
select_week(false);
select_week(12);
select_week('Raphaële');
select_week(0);
select_week('');

/**
 * Teste la fonction BUILD_LIST
 */
$girls = array('Rokia', 'Raphaële', 'Maeliss', 'Inas');

echo build_list($girls);
echo build_list($girls, true);

/**
 * Teste les fonctions BUILD_LIST et GENERATE_WORD
 */
$words = [];

for ($i = 0; $i < 100; $i++) {
    array_push($words, generate_word());
}

echo build_list($words);

/**
 * Teste la fonction AGE
 */
echo '<p>Test 1 : ' . age('1998-07-12', '2018-07-15');
echo '<p>Test 2 : ' . age('01/02/2003', '2007-02-01');
echo '<p>Test 3 : ' . age(123456789, 987654321);
echo '<p>Test 4 : ' . age('Toto aime', 'les gâteaux');

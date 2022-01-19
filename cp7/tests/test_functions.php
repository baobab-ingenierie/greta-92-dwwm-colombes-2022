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


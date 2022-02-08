<?php
include_once 'database.class.php';

echo preg_match(Database::REGEX_HOST, 'localhost');
exit;

$bdd = new Database('mysql', 'localhost', 3306, 'colombes', 'root', 'root');
$data = $bdd->getData('SELECT * FROM user');
var_dump($data);

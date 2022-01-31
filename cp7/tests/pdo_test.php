<?php
include_once '../inc/globals.php';

try {
    $conn = new PDO(
        sprintf('mysql:host=%s;dbname=%s;charset=utf8', HOST, DATA),
        USER,
        PASS,
        OPTIONS
    );

    $res = $conn->prepare('SHOW tables;');

    $res->execute();
    
    var_dump($res->fetchAll());
} catch (PDOException $err) {
    echo $err->getMessage();
}

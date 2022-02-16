<?php
$t = null;
$k = null;
$v = null;
$status = false;

if (isset($_GET['t']) && !empty($_GET['t'])) {
    $t = htmlspecialchars($_GET['t']);
}

if (isset($_GET['k']) && !empty($_GET['k'])) {
    $k = htmlspecialchars($_GET['k']);
}

if (isset($_GET['v'])) {
    $v = htmlspecialchars($_GET['v']);
}

if ($t && $k) {
    try {
        include_once 'inc/globals.php';
        include_once 'class/database.class.php';
        include_once 'class/model.class.php';

        $myTable = new Model('mysql', HOST, PORT, DATA, USER, PASS, $t);

        if (empty($v)) {
            $status = $myTable->insert($_POST);
        } else {
            $status = $myTable->update($_POST, $k, $v);
        }

        if ($status) {
            header('location:list.php?t=' . $t . '&k=' . $k);
        } else {
            echo 'Ooops !';
        }
    } catch (Exception $err) {
        echo $err->getMessage();
    }
}

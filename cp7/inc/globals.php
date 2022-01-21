<?php

/**
 * Variables et constantes globales pour gérer les différents 
 * environnements (TEST et PROD)
 */

if ($_ENV['HTTP_HOST'] === 'localhost' || $_ENV['HTTP_HOST'] === '127.0.0.1') {
    // Connexion à la BDD
    define('HOST', 'localhost');
    define('DATA', 'colombes');
    define('USER', 'root');
    define('PASS', 'root');
    // Gestion des erreurs (local uniquement)
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    define('HOST', '');
    define('DATA', '');
    define('USER', '');
    define('PASS', '');
}

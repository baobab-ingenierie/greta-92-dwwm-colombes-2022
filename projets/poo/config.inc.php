<?php

/**
 * Ce fichier de configuration est un simple fichier contenant quatre 
 * constantes permettant de stocker les paramètres de connexion à la 
 * base de données : l’adresse de la base, le nom de la base, le nom 
 * d’utilisateur et le mot de passe.
 */

// Affichage des messages d'erreurs
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// Paramètres de connexion à la base de données
define('DB_HOST', 'localhost'); // Adresse de la base, généralement localhost
define('DB_NAME', 'singleton'); // Nom de la base de données
define('DB_USER', 'root'); // Nom de l'utilisateur MySQL
define('DB_PASS', 'root'); // Mot de passe de l'utilisateur
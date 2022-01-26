<?php

/**
 * CONFIGURATION GMAIL
 * - Activer l'accès IMAP
 * - Cliquer sur le lien suivant pour autoriser les apps moins sécurisées : 
 * https://www.google.com/settings/security/lesssecureapps
 */
include_once 'gmail_constants.php';
$inbox = imap_open(MB_HOST, MB_USER, MB_PASS) or die('Connexion à Gmail impossible : ' . imap_last_error());
$msg = imap_fetchbody($inbox, $_GET['id'], 1); // 2 pour HTML riche
echo quoted_printable_decode($msg);
echo $msg;
imap_close($inbox);

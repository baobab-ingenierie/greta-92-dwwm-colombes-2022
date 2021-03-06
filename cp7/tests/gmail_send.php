<?php

/**
 * UBUNTU
 * Mettre à jour le cache de paquets apt :
 * $ sudo apt-update
 * Installer le package postfix avec la commande suivante :
 * $ sudo DEBIAN_PRIORITY=low apt install postfix
 * Configurer postfix en répondant aux questions
 * Redémarrer le serveur web
 * $ sudo service apache2 restart
 * 
 * INSTALLATION DE SENDMAIL : WINDOWS
 * Télécharger Sendmail à partir du site officiel : 
 * https://www.glob.com.au/sendmail/sendmail.zip
 * Extraire son contenu dans un dossier (Exemple : d:\apps\sendmail)
 * Ouvrir sendmail.ini et définir les variables suivantes :
 * - smtp_server=smtp.gmail.com
 * - smtp_port=587
 * - auth_username=greta.hds@gmail.com
 * - auth_password=Secret1234
 * Fermer en sauvegardant
 * 
 * CONFIGURATION PHP : WINDOWS
 * Ouvrir le php.ini à partir de votre serveur local puis 
 * commenter les variables suivantes si présentes :
 * - ;SMTP = localhost
 * - ;smtp_port = 25
 * - ;auth_username =
 * - ;auth_password =
 * - ;sendmail_from = me@example.com -> Windows seulement
 * Définir ensuite la variable suivante si pas présente :
 * - sendmail_path="d:\apps\sendmail\sendmail.exe -t"
 * 
 * CONFIGURATION GMAIL
 * Créer et utiliser des mots de passe d'application :
 * Accéder au compte Google : https://myaccount.google.com/
 * Sélectionner "Sécurité"
 * Sous "Se connecter à Google", sélectionner "Mots de passe des applications"
 */

$to = "greta.oise@gmail.com,webmaster@baobab-ingenierie.fr";
$subject = "Test mail PHP";
$message = "
<html>
<head>
<title>Ceci est un test de mail PHP</title>
</head>
<body>
<p>Test mail PHP. Ne pas tenir compte.</p>
<a href=\"https://www.google.fr/search?q=php\">https://www.google.fr/search?q=php</a>
</body>
</html>
";

// Obligatoire pour définir le type de contenu du mail
$headers = "MIME-Version: 1.0 \r\n";
$headers .= "Content-type:text/html;charset=UTF-8 \r\n";

// Plus d'en-tête : From est requis, le reste est optionnel
$headers .= "From: manu.croncron@elysees.fr \r\n";
$headers .= "Cc: jeannot.tetex@elysees.fr \r\n";

// Envoi du mail
$res = mail($to, $subject, $message, $headers);
echo ($res ? 'Succès' : 'Echec');

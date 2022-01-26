<?php
var_dump($_POST);

/**
 * Slides 206 à 208 : PDO et PDOStatement
 * Slides 232 à 235 : requêtes préparées
 * 
 * A l'aide de la variable POST, insérer d'abord les données
 * dans la table CUSTOMER de la manière suivante :
 * - store_id = 1
 * - first_name = (formulaire)
 * - last_name = (formulaire)
 * - email = (formulaire)
 * - address_id = (formulaire)
 * - create_date = (date du jour = now())
 * Récupérer l'ID généré dans CUSTOMER
 * 
 * Insérer ensuite les données dans la table USER de la 
 * manière suivante :
 * - user_id = (même ID que dans CUSTOMER)
 * - password = (formulaire) avec algo de cryptage
 * - role = 1
 * 
 * Router vers la page index.php :
 * - si réussite avec le code 5 et un message 
 * - si échec avec le code 6 et un message 
 */
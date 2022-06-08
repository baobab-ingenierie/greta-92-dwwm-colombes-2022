<?php

/**
 * Classe Singleton utilisant un design pattern Singleton
 * 
 * @author  Prenom Nom <prenomnom@gmail.com>
 * @version 1.0
 */

class Singleton
{

    static private $oPDO = null;
    static private $oInstance = null;

    /**
     * Constructeur défini en privé pour le rendre inaccessible et destiné
     * à initier la connexion à la base de données en utilisant l’extension PDO
     */
    private function __construct()
    {
        self::$oPDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        self::$oPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$oPDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    /**
     * Methode magique de destruction de l'instance MySQL
     */
    public function __destruct()
    {
        self::$oPDO = null;
    }

    /**
     * Methode magique clone verrouillée via une exception
     */
    public function __clone()
    {
        throw new Exception('Impossible de cloner une connexion SQL protégée par un singleton.');
    }

    /**
     * Méthode magique pour rétablir toute connexion de base de données 
     * qui aurait été perdue durant la linéarisation
     */
    public function __wakeUp()
    {
        // Vérification de la connexion
        if (self::$oInstance instanceof self) {
            throw new Exception('Erreur !');
        }
        // Correction de la reference
        self::$oInstance = $this;
    }

    /**
     * Méthode magique pour l'appel des fonctions de l'objet PDO quand 
     * elles ne sont pas définies dans la classe
     * 
     * @param type $method
     * @param type $params
     */
    public function __call($method, array $params = [])
    {
        if (self::$oPDO == NULL) {
            self::__construct();
        }

        return call_user_func_array(array(self::$oPDO, $method), $params);
    }

    /**
     * Fournit l'unique instance du Singleton déclarée en statique qui va
     * permettre de récupérer l’instance de connexion à la base de données
     *
     * @return  Singleton
     */
    static public function getInstance()
    {
        // Vérification que l'instance n'a pas déjà été initialisée
        if (!(self::$oInstance instanceof self)) {
            self::$oInstance = new self();
        }
        // Retour de l'instance unique
        return self::$oInstance;
    }
}

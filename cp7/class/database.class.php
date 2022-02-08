<?php

/**
 * Classe Database :
 * Mini framework permettant la connexion à une base de données MySQL/MariaDB, PostgreSQL ou SQLite
 */

class Database
{
    // Attributs privés
    private $engine;
    private $host;
    private $port;
    private $dbname;
    private $user;
    private $pass;
    private $cnn;
    private $connected = false;

    // Accesseurs
    public function getEngine(): string
    {
        return $this->engine;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getDBName(): string
    {
        return $this->dbname;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    // Mutateurs :
    // Host -> RegExp pour limiter à "([0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}:[0-9]{2,4})|([a-z]{1,30}:[0-9]{2,4})"
    // Port -> nombre entier positif
    // DBName et User -> RegExp pour limiter à "[A-Za-z]{1,30}" avec preg_match
    // Pass = standard



}

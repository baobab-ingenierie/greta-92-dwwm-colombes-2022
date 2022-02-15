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
    private $dsn;
    private $cnn;
    private $connected = false;

    // Constantes de classe
    const REGEX_HOST = '/([0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3})|([a-z]{1,30})/';
    const REGEX_OBJECT = '/[A-Za-z_]{1,30}/';

    const ENGINE_MYSQL = 'mysql';
    const ENGINE_MARIADB = 'mariadb';
    const ENGINE_POSTGRESQL = 'postgresql';
    const ENGINE_SQLITE = 'sqlite';

    // Constructeur
    public function __construct(
        string $newEngine,
        string $newHost,
        int $newPort,
        string $newDBName,
        string $newUser,
        string $newPass
    ) {
        // Assigne la valeur de chaque argument à son attribut idoine
        $this->setEngine($newEngine);
        $this->setHost($newHost);
        $this->setPort($newPort);
        $this->setDBName($newDBName);
        $this->setUser($newUser);
        $this->setPass($newPass);

        // Tente de se connecter à la BDD
        try {
            // Selon le moteur de BDD
            switch ($this->getEngine()) {
                case self::ENGINE_MYSQL:
                case self::ENGINE_MARIADB:
                    $this->cnn = new PDO(sprintf($this->dsn, $this->getHost(), $this->getDBName()), $this->getUser(), $this->getPass());
                    break;
                case self::ENGINE_POSTGRESQL:
                    $this->cnn = new PDO(sprintf($this->dsn, $this->getHost(), $this->getPort(), $this->getDBName(), $this->getUser(), $this->getPass()));
                    break;
                case self::ENGINE_SQLITE:
                    $this->cnn = new PDO(sprintf($this->dsn, $this->getHost()));
                    break;
                default:
                    throw new PDOException(__CLASS__ . ' : La connexion a échoué.');
            }

            // Définit les attributs de connexion PDO
            $this->cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connected = true;
        } catch (PDOException $err) {
            throw new PDOException($err->getMessage());
        }
    }

    // Méthodes publiques

    /**
     * Méthode qui renvoie le résultat d'une requête SELECT sous la forme d'un tableau associatif
     */

    public function getData(string $sql, array $params = array()): array
    {
        try {
            // Teste si la requête commence par SELECT
            $words = explode(' ', strtolower($sql));
            if ($words[0] === 'select') {
                $res = $this->cnn->prepare($sql);
                $res->execute($params);
                return $res->fetchAll();
            } else {
                throw new Exception(__CLASS__ . ' : La requête doit commencer par SELECT.');
            }
        } catch (PDOException $err) {
            throw new PDOException($err->getMessage());
        }
    }

    /**
     * Méthode qui renvoie le résultat d'une requête SELECT sous la forme d'un flux JSON
     * @param string $sql requête SELECT à exécuter
     * @param array $params tableau de paramètres optionnel 
     */

    public function getJSON(string $sql, array $params = array()): string
    {
        return json_encode($this->getData($sql, $params));
    }

    /**
     * Méthode qui renvoie le résultat d'une requête SELECT sous la forme d'un élément HTML TABLE
     * @param string $sql
     * @param array $params optionnel
     * @param array $crud  tableau associatif contenant le nom de la table et le nom de la colonne PK (optionnel)
     */

    public function makeTable(string $sql, array $params = array(), array $crud = array()): string
    {
        try {
            // Prépare et exécute la requête
            $res = $this->getCnn()->prepare($sql);
            $res->execute($params);
            $dataset = $res->fetchAll();

            // var_dump($dataset);

            // Génère le tableau HTML
            $html = '<table id="dataTable" class="table table-striped">';

            // Parcourt les en-têtes de colonne et les inscrit en début de tableau
            $html .= '<thead>';
            for ($i = 0; $i < $res->columnCount(); $i++) {
                $meta = $res->getColumnMeta($i);
                $html .= '<th>' . $meta['name'] . '</th>';
            }
            // Si CRUD alors nouvelle colonne
            if (!empty($crud)) {
                $html .= '<th></th>';
            }
            $html .= '</thead>';

            // Parcourt le dataset et écrit les lignes et colonnes lues
            $html .= '<tbody>';
            foreach ($dataset as $val) {
                $html .= '<tr>';
                foreach ($val as $val2) {
                    $html .= '<td>' . $val2 . '</td>';
                }
                // Si CRUD alors nouvelle colonne
                if (!empty($crud)) {
                    $html .=
                        '<td>
                            <a href="edit.php?t=' . $crud['t'] . '&k=' . $crud['k'] . '&v=" class="btn btn-success btn-sm">C</a>

                            <a href="edit.php?t=' . $crud['t'] . '&k=' . $crud['k'] . '&v='. $val[$crud['k']]  .'" class="btn btn-warning btn-sm">U</a>

                            <a href="edit.php?t=' . $crud['t'] . '&k=' . $crud['k'] . '&v='. $val[$crud['k']]  .'" class="btn btn-danger btn-sm">D</a>
                        </td>';
                }
                $html .= '</tr>';
            }

            $html .= '</tbody>';
            $html .= '</table>';
            return $html;
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

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

    public function getCnn(): PDO
    {
        return $this->cnn;
    }

    // Mutateurs :
    public function setHost(string $newHost)
    {
        // Teste si $newHost matche avec le RegEx
        if (preg_match(self::REGEX_HOST, $newHost) === 1) {
            $this->host = $newHost;
        } else {
            throw new Exception(__CLASS__ . ' : La valeur de host est incorrecte : ' . self::REGEX_HOST);
        }
    }

    public function setPort(int $newPort)
    {
        if ($newPort > 0 && $newPort < 65537) {
            $this->port = $newPort;
        } else {
            throw new Exception(__CLASS__ . ' : Numéro du port invalide.');
        }
    }

    public function setDBName(string $newDBName)
    {
        if (preg_match(self::REGEX_OBJECT, $newDBName) === 1) {
            $this->dbname = $newDBName;
        } else {
            throw new Exception(__CLASS__ . ' : La valeur de dbname est incorrecte : ' . self::REGEX_OBJECT);
        }
    }

    public function setUser(string $newUser)
    {
        if (preg_match(self::REGEX_OBJECT, $newUser) === 1) {
            $this->user = $newUser;
        } else {
            throw new Exception(__CLASS__ . ' : La valeur du username est incorrecte : ' . self::REGEX_OBJECT);
        }
    }

    public function setPass(string $newPass)
    {
        $this->pass = $newPass;
    }

    public function setEngine(string $newEngine)
    {
        // Selon le moteur choisi, génère la DSN correspondante
        $newEngine = strtolower($newEngine);
        switch ($newEngine) {
            case self::ENGINE_MYSQL:
            case self::ENGINE_MARIADB:
                $this->engine = $newEngine;
                $this->dsn = 'mysql:host=%s;dbname=%s;charset=utf8';
                break;
            case self::ENGINE_POSTGRESQL:
                $this->engine = $newEngine;
                $this->dsn = 'pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s;charset=utf8';
                break;
            case self::ENGINE_SQLITE:
                $this->engine = $newEngine;
                $this->dsn = 'sqlite:%s';
                break;
            default:
                throw new Exception(__CLASS__ . ' : Valeur de engine incorrecte, utiliser plutôt : MySQL, Mariadb, PostgreSQL ou SQLite.');
        }
    }
}

<?php

// Imports
include_once 'database.class.php';

/**
 * Classe finale Model qui hérite de Database
 */

final class Model extends Database
{
    // Attributs de la classe fille
    private $db = null;
    private $table = '';

    /**
     * Constructeur
     */

    public function __construct(
        string $newEngine,
        string $newHost,
        int $newPort,
        string $newDBName,
        string $newUser,
        string $newPass,
        string $newTable
    ) {
        $this->setTable($newTable);
        $this->db = new Database($newEngine, $newHost, $newPort, $newDBName, $newUser, $newPass);
    }

    /**
     * Méthode qui renvoie toutes les lignes de la table en cours
     * @param string $sql requête SQL à exécuter
     * @return array résultat de la requête SELECT sous la forme d'un tableau associatif
     */

    public function getRows(string $sql = ''): array
    {
        try {
            $sql = ($sql === '') ?  'SELECT * FROM ' . $this->getTable() : $sql;
            return $this->db->getData($sql);
        } catch (PDOException $err) {
            throw new PDOException($err->getMessage());
        }
    }

    /**
     * Méthode qui renvoie une seule ligne de la table en cours
     * @param string $pk nom de la colonne clé primaire
     * @param string $id valeur de la clé primaire à trouver
     * @return array
     */
    public function getRow(string $pk, string $id): array
    {
        try {
            $sql = 'SELECT * FROM ' . $this->getTable() . ' WHERE ' . $pk . '=?';
            $params = array($id);
            return $this->db->getData($sql, $params);
        } catch (PDOException $err) {
            throw new PDOException($err->getMessage());
        }
    }

    /**
     * Méthode qui insère une nouvelle ligne dans la table en cours
     * @param array $data tableau associatif contenant les valeurs à insérer dans la table associées à leur colonne respective comme $_POST
     * @return int nombre de lignes insérées
     */

    public function insert(array $data): bool
    {
        try {
            // Remplit le tableau de paramètres
            foreach ($data as $key => $val) {
                $params[':' . $key] = htmlspecialchars($val);
            }

            // Ecrit la requête paramétrée
            $sql = 'INSERT INTO %s(%s) VALUES(%s)';
            $cols = implode(',', array_keys($data));
            $vals = implode(',', array_keys($params));
            $sql = sprintf($sql, $this->getTable(), $cols, $vals);

            // Prépare et exécute la requête
            $res = $this->db->getCnn()->prepare($sql);
            return $res->execute($params);
            // return $res->rowCount();
        } catch (PDOException $err) {
            throw new PDOException($err->getMessage());
        }
    }

    /**
     * Méthode qui met à jour une ligne dans la table en cours
     * @param array $data tableau associatif de type $_POST contenant le nom des colonnes associé à leur valeur
     * @param string $pk nom de la colonne clé primaire
     * @param string $id valeur de la colonne clé primaire
     * @return bool vrai si la requête a réussi
     */

    public function update(array $data, string $pk, string $id): bool
    {
        try {
            // Remplit le tableau de paramètres
            foreach ($data as $key => $val) {
                $params[':' . $key] = htmlspecialchars($val);
                $set[] = $key . '=:' . $key;
            }
            $params[':id'] = $id;

            // Ecrit la requête paramétrée
            $sql = 'UPDATE %s SET %s WHERE %s=:id';
            $cols = implode(',', $set);
            $sql = sprintf($sql, $this->getTable(), $cols, $pk);

            // Prépare et exécute la requête
            $res = $this->db->getCnn()->prepare($sql);
            return $res->execute($params);
        } catch (PDOException $err) {
            throw new PDOException($err->getMessage());
        }
    }

    /**
     * Méthode qui supprime une ou plusieurs ligne dans la table en cours
     * @param string $pk nom de la colonne clé primaire
     * @param array $ids tableau de valeurs de la colonne clé primaire à supprimer
     */

    public function delete(string $pk, array $ids = array()): int
    {
        try {
            // Si liste ID non
            if (!empty($ids)) {
                // Ecrit la requête paramétrée
                $sql = 'DELETE FROM %s WHERE %s IN (%s)';
                $vals = implode(',', $ids);
                $sql = sprintf($sql, $this->getTable(), $pk, $vals);

                echo $vals;

                // Prépare et exécute la requête
                $res = $this->db->getCnn()->prepare($sql);
                return $res->execute();
            } else {
                throw new Exception(__CLASS__ . ' : indiquer en second argument la liste des ids à supprimer.');
            }
        } catch (PDOException $err) {
            throw new PDOException($err->getMessage());
        }
    }

    /**
     * Accesseurs/Mutateurs
     */

    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $newTable)
    {
        if (preg_match(parent::REGEX_OBJECT, $newTable) === 1) {
            $this->table = $newTable;
        } else {
            throw new Exception(__CLASS__ . ' : La valeur de table est incorrecte.');
        }
    }
}

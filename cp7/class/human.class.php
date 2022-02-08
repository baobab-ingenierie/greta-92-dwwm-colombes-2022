<?php

// Imports
include_once 'animal.class.php';

/**
 * Class Human qui hérite de Animal
 */

class Human extends Animal
{
    // Attribut privé
    private $fname = '';

    // Constructeur
    public function __construct(
        string $newName,
        string $newFname,
        string $newDob
    ) {
        // Assigne la valeur des arguments aux attributs
        $this->name = $newName;
        $this->setFname($newFname);
        $this->setDob($newDob);
    }

    // Accesseurs/Mutateurs
    public function getFname(): string
    {
        return $this->fname;
    }

    public function setFname(string $newFname)
    {
        // TO DO : tester si $newFname match avec un pattern RegExp
        $this->fname = $newFname;
    }

    public function setWeight(float $newWeight)
    {
        // ATTENTION : dans notre conception, le poids de l'humain doit être compris entre 0 et 200kg (record 650kg)
        if ($newWeight < 0 || $newWeight > 200) {
            throw new Exception(__CLASS__ . ' : Le poids de l\'humain doit être compris entre 0 et 200kg.');
        } else {
            $this->weight = $newWeight;
        }
    }

    // Méthode publique
    public function move()
    {
        switch ($this->getEnv()) {
            case self::ENV_AIR:
                $verb = 'tombe';
                break;
            case self::ENV_GROUND:
                $verb = 'marche ou rampe';
                break;
            case self::ENV_WATER:
                $verb = 'nage';
                break;
            default:
                $verb = 'avance';
        }
        return $this->name . ' ' . $verb;
    }
}

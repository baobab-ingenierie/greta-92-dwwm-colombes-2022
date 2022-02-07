<?php

/**
 * Classe Animal
 */

class Animal
{
    // Attributs publics
    public $name = '';

    // Attributs privés
    private $dob = '';
    private $weight = 0.0;
    private $female = true;

    // Constantes de classe : environnement de l'animal
    const ENV_AIR = 'air';
    const ENV_WATER = 'eau';
    const ENV_GROUND = 'terre';
    const ENV_OTHER = 'autre';

    // Constructeur
    public function __construct(
        string $newName = '',
        string $newDob = '',
        float $newWeight = 0,
        bool $newFemale = false
    ) {
        // Assignation d'une valeur aux attributs public
        $this->name = $newName;

        // Assignation d'une valeur aux attributs privés
        if ($newDob) {
            $this->setDob($newDob);
        } else {
            $this->setDob(date('Y-m-d'));
        }
        $this->setWeight($newWeight);
        $this->setFemale($newFemale);
    }

    // Méthodes publiques

    /**
     * Ecrire la méthode 'eat' qui permet à un animal de manger un autre animal : le poids de la proie vient s'ajouter à celui du prédateur
     */

    public function eat(Animal $prey)
    {
        // Récupère le poids de la proie
        $this->setWeight($prey->getWeight() + $this->getWeight());

        // RAZ du poids de la proie
        $prey->setWeight(0);
    }

    // Méthodes privées
    private function is_date($arg): bool
    {
        return (bool) strtotime($arg);
    }

    // Méthodes pour modifier la valeur des attributs privés : mutateurs ou setters
    public function setDob(string $newDob)
    {
        if ($this->is_date($newDob)) {
            $this->dob = $newDob;
        } else {
            throw new Exception('La date passée en paramètre est incorrecte.');
        }
    }

    public function setWeight(float $newWeight)
    {
        // ATTENTION : dans notre conception, le poids de l'animal doit être compris entre 0 et 500kg
        if ($newWeight < 0 || $newWeight > 500) {
            throw new Exception(__CLASS__ . ' : Le poids de l\'animal doit être compris entre 0 et 500kg.');
        } else {
            $this->weight = $newWeight;
        }
    }

    public function setFemale(bool $newFemale)
    {
        if (is_bool($newFemale)) {
            $this->female = $newFemale;
        } else {
            throw new Exception('L\'argument doit être un booléen.');
        }
    }

    // Méthodes pour accéder à la valeur des attributs privés : accesseurs ou getters
    public function getDob(): string
    {
        return $this->dob;
    }

    public function getAge(): int // readonly
    {
        // Utilise la classe DateTime
        $date1 = new DateTime(date('Y-m-d'));
        $date2 = new DateTime($this->getDob());
        $diff = $date2->diff($date1);
        if ($diff->y != 0) {
            return $diff->y;
        }
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getFemale(): bool
    {
        return $this->female;
    }

    // Destructeur
    public function __destruct()
    {
        echo '<p>'.$this->name.' a été détruit(e) !</p>';
    }
}

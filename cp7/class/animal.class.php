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
    private $env = '';

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
        bool $newFemale = false,
        string $newEnv = ''
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
        $this->setEnv($newEnv);
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

    public function move()
    {
        switch ($this->getEnv()) {
            case self::ENV_AIR:
                $verb = 'vole';
                break;
            case self::ENV_GROUND:
                $verb = 'marche ou rampe';
                break;
            case self::ENV_WATER:
                $verb = 'nage';
                break;
            default:
                $verb = 'recule';
        }
        return $this->name . ' ' . $verb;
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

    public function setEnv(string $newEnv)
    {
        // Tester si $newEnv vaut 'eau', 'terre' ou 'air' en utilisant les constantes de classe -> self::ENV_WATER. Si aucune des trois valeurs alors $newEnv vaut self::ENV_OTHER
        // Exemples:
        // $toutou->setEnv('Terre') => 'terre'
        // $toutou->setEnv('coucou') => 'autre'
        // $toutou->setEnv('EAU') => 'eau'

        $env = strtolower($newEnv);

        // Crée les dictionnaires d'environnements
        $air = array('air', 'aérien', 'ciel', 'volant', 'aéro', 'vol');
        $water = array('eau', 'aquatique', 'flotte', 'rivière', 'lac', 'mer');
        $ground = array('terre', 'sol', 'bitume', 'terrestre', 'terrain', 'forêt', 'savane');

        switch ($env) {
            case in_array($env, $ground):
                $this->env = self::ENV_GROUND;
                break;
            case in_array($env, $air):
                $this->env = self::ENV_AIR;
                break;
            case in_array($env, $water):
                $this->env = self::ENV_WATER;
                break;
            default:
                $this->env = self::ENV_OTHER;
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

    public function getEnv(): string
    {
        return $this->env;
    }

    // Destructeur
    public function __destruct()
    {
        echo '<p>' . $this->name . ' a été détruit(e) !</p>';
    }
}

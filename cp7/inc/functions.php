<?php

/**
 * Procédure qui génère un élément HTML SELECT
 * contenant les 7 jours de la semaine
 */
function select_week(bool $full = false)
{
    $weekdays = array(
        'lu' => 'Lundi',
        'ma' => 'Mardi',
        'me' => 'Mercredi',
        'je' => 'Jeudi',
        've' => 'Vendredi'
    );

    $weekend = array(
        'sa' => 'Samedi',
        'di' => 'Dimanche'
    );

    if ($full) {
        $week = array_merge($weekdays, $weekend);
    } else {
        $week = $weekdays;
    }

    $html = '<select>';

    foreach ($week as $key => $val) {
        $html .= '<option value="' . $key . '">' . $val . '</option>';
        // OU BIEN $html .= "<option value=\"$key\">$val</option>";
    }

    $html .= '</select>';

    echo $html;
}

/**
 * Fonction qui renvoie un élément HTML OL/UL 
 * contenant les membres du tableau passé en paramètre
 * @param array $data tableau clé/valeur simple
 * @param bool $ordered true : liste ordonnée / false : liste non ordonnée
 * @return string code HTML correspondant à la liste complète
 * @author Lesly LODIN
 * @version 1.0
 */
function build_list(array $data, bool $ordered = false): string
{
    if ($ordered) {
        $html = '<ol>%s</ol>';
    } else {
        $html = '<ul>%s</ul>';
    }

    $items = '';

    foreach ($data as $val) {
        $items .= '<li>' . $val . '</li>';
    }

    return sprintf($html, $items);
}

/**
 * Fonction qui renvoie un mot de passe aléatoire
 * dont la longueur est comprise entre 8 et 16
 * @return string mot passe généré
 */
function generate_word(): string
{
    $consumns = 'BCDFGHJKLMNPQRSTVWXZbcdfghjklmnpqrstvwxz';
    $vowels = 'AEIOUYaeiouy';
    $word = '';

    for ($i = 0; $i < rand(4, 8); $i++) {
        $word .= substr($consumns, rand(0, strlen($consumns) - 1), 1) . substr($vowels, rand(0, strlen($vowels) - 1), 1);
    }

    return $word;
}

/**
 * Fonction qui renvoie la différence entre deux dates en
 * années
 * @param string date1 une date
 * @param string date2 une autre date
 * @return int âge en années
 */
function age(string $date1, string $date2): int
{
    // Indique si les arguments sont bien des dates
    if (!is_date($date1) || !is_date($date2)) {
        trigger_error('Format invalide : L\'un des deux arguments n\'est pas une date', E_USER_WARNING);
    }

    // Convertit les arguments entrés sous forme de string en dates
    $date1 = strtotime($date1);
    $date2 = strtotime($date2);

    if ($date1 > $date2) {
        $result = $date1 - $date2;
    } elseif ($date2 > $date1) {
        $result = $date2 - $date1;
    } else {
        $result = 0;
    }

    return floor($result / 60 / 60 / 24 / 365.25);
}

/**
 * Fonction qui renvoie vrai si l'argument est une date
 */
function is_date($arg): bool
{
    return (bool) strtotime($arg);
}

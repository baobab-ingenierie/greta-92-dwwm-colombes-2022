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
function generate_password(): string
{
    $consumns = 'BCDFGHJKLMNPQRSTVWXZbcdfghjklmnpqrstvwxz';
    $vowels = 'AEIOUYaeiouy';
}

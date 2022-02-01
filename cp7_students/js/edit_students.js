/**
 * Fonction événementielle qui va remplir la liste des 
 * pays à la fin du chargement de la page
 */

document.addEventListener(
    'DOMContentLoaded',
    function () {
        // 1. Instancier l'objet requête AJAX
        let xhr = new XMLHttpRequest();

        // 2. Prépare la requête AJAX
        xhr.open(
            'get',
            'https://restcountries.com/v3.1/all?fields=cca2,translations',
            true
        );

        // 3. Gestion de l'événement readyState 
        xhr.addEventListener(
            'readystatechange',
            function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = xhr.responseText; // text
                    let data = JSON.parse(response); // object
                    let option;
                    for (let i = 0; i < data.length; i++) {
                        option = document.createElement('option');
                        option.value = data[i].cca2;
                        option.textContent = data[i].translations.fra.common;
                        document.getElementById('region').appendChild(option);
                    }
                } else {
                    console.log(xhr.readyState);
                }
            }
        );

        // 4. Envoie la requête AJAX
        xhr.send();
    }
);
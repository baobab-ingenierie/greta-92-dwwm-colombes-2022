/**
 * Branche un écouteur d'événement sur la soummission 
 * du formulaire pour tester les mots de passes avant
 * l'envoi
 */

// document.getElementsByTagName['form'][0]
document.getElementById('formRegister').addEventListener(
    'submit',
    function (evt) {
        // Stoppe l'événement submit
        evt.preventDefault();

        // Teste l'égalité des deux mots de passe
        if (document.getElementById('password').value === document.getElementById('password2').value) {
            this.submit();
        } else {
            alert('Les mots de passe ne correspondent pas.');
        }
    }
);
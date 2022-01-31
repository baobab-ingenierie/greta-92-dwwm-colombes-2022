<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Stream : Inscription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://fr.m.wikipedia.org/wiki/Fichier:Circle-icons-video.svg" type="image/x-icon">
</head>

<body class="container">
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Inscription</h5>
                </div>
                <form action="register_check.php" method="post" id="formRegister">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="first_name">Prénom</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" minlength="1" maxlength="45" pattern="[A-Za-z\u00c0-\u00ff\- ']{1,45}" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Nom</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" minlength="1" maxlength="45" pattern="[A-Za-z\u00c0-\u00ff\- ']{1,45}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Courriel</label>
                            <input type="email" inputmode="email" name="email" id="email" class="form-control" minlength="1" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="address_id">Adresse</label>
                            <select name="address_id" id="address_id" class="form-control">
                                <?php
                                try {
                                    include_once 'inc/globals.php';

                                    $conn = new PDO('mysql:host=' . HOST . ';dbname=' . DATA . ';charset=utf8', USER, PASS, OPTIONS);

                                    $sql = "SELECT address_id, CONCAT(address, ' ', postal_code, ' ', city, ' ', country) AS address
                                    FROM address
                                      INNER JOIN city 
                                        ON city.city_id = address.city_id
                                      INNER JOIN country
                                        ON country.country_id = city.country_id";

                                    $res = $conn->prepare($sql);

                                    $res->execute();

                                    $html = '';
                                    while ($row = $res->fetch()) {
                                        $html .= sprintf('<option value="%s">%s</option>', $row['address_id'], $row['address']);
                                    }
                                    echo $html;
                                } catch (PDOException $err) {
                                    echo '<p class="alert alert-danger">' . $err->getMessage() . '</p>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" minlength="8" maxlength="20" pattern="((?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[_=]).{8,20})" title="8 à 20 caractères requis : A à Z, a à z, 0 à 9, _ et =" required>
                        </div>
                        <div>
                            <label for="password2">Vérification</label>
                            <input type="password" id="password2" class="form-control" minlength="8" maxlength="20" pattern="((?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[_=]).{8,20})" title="8 à 20 caractères requis : A à Z, a à z, 0 à 9, _ et =" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="S'inscrire" class="btn btn-primary">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <script src="js/login.js"></script>
    <script src="js/register.js"></script>
</body>

</html>
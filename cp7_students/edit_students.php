<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body class="container">
    <h1>Students</h1>

    <form action="save_students.php" method="post">
        <div class="form-group">
            <label for="fname">Prénom</label>
            <input type="text" name="fname" id="fname" class="form-control">
        </div>
        <div class="form-group">
            <label for="dob">Date de naissance</label>
            <input type="date" name="dob" id="dob" class="form-control">
        </div>
        <div class="form-group">
            <label for="sex">Sexe</label>
            <select name="sex" id="sex" class="form-control">
                <option value="">--- Choississez une option ---</option>
                <option value="F">Féminin</option>
                <option value="M">Masculin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Courriel</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="region">Pays</label>
            <select name="region" id="region" class="form-control">
                <option value="">--- Choississez une option ---</option>
            </select>
        </div>
        <div class="form-group">
            <label for="zip">CP</label>
            <input type="text" name="zip" id="zip" class="form-control">
        </div>
        <div class="form-group">
            <label for="city">Ville</label>
            <input type="text" id="city" class="form-control">
        </div>
        <input type="submit" value="Enregistrer" class="btn btn-primary">
    </form>

    <script src="js/edit_students.js"></script>
</body>

</html>
<?php
// Démarre ou restaure une session
session_start();

// Teste si user est authentifié
if (isset($_SESSION['isauth']) && $_SESSION['isauth']) {
    $isauth = true;
} else {
    $isauth = false;
    // header('location:index.php?code=3');
}

// Teste si role est défini
if (isset($_SESSION['role']) && $_SESSION['role']) {
    $role = $_SESSION['role'];
} else {
    $role = 1;
}

?>

<?php
// Constante nom application
// define('APP_NAME', 'Live Stream');
const APP_NAME = "Live Stream";

// Ecart en jours
$today = strtotime("now");

// $today = strtotime(date("Y-m-d"));
$start = strtotime("2022-01-13");
$gap = floor(($today - $start) / 60 / 60 / 24);

// Tableau des membres de l'équipe
include_once 'inc/team.inc.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> : VOD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="container">
    <div class="jumbotron">
        <h1 class="display-4"><?php echo APP_NAME; ?></h1>
        <p class="lead">Bienvenue sur la plateforme <?php echo APP_NAME; ?>. Ce site a été mis en ligne par la Garamont Coders Crew il y a <?php echo $gap; ?> jours. Elle permet de louer des films full HD en-ligne ou via notre application mobile.</p>
        <hr>

        <a href="register.php" class="btn btn-info <?php echo ($isauth ? 'd-none' : ''); ?>">Inscription</a>
        <a href="login.php" class="btn btn-primary <?php echo ($isauth ? 'd-none' : ''); ?>">Connexion</a>
        <a href="logout.php" class="btn btn-danger <?php echo (!$isauth ? 'd-none' : ''); ?>">Déconnexion</a>
        <a href="list_users.php" class="btn btn-warning <?php echo (!$isauth ? 'd-none' : ''); ?>">Utilisateurs</a>
        <a href="bo.php" class="btn btn-success">Back-office</a>
    </div>

    <?php
    if (isset($_GET['code']) && !empty($_GET['code'])) {
        switch ($_GET['code']) {
            case 9:
                $col = 'warning';
                $msg = 'Login ou mot de passe incorrect.';
                break;
            case 1:
                $col = 'success';
                $msg = 'Bienvenue ' . ($isauth ? $_SESSION['fname'] : '') . ' !';
                break;
            case 2:
                $col = 'danger';
                $msg = 'Une erreur est survenue avec la BDD.';
                break;
            case 3:
                $col = 'info';
                $msg = 'Vous devez être connecté pour accéder à ces fonctionnalités.';
                break;
            case 4:
                $col = 'info';
                $msg = 'La session est échue.';
                break;
        }

        if (isset($col) && isset($msg)) {
            echo '<div class="alert alert-' . $col . ' alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
    ?>

    <h2>Notre équipe</h2>

    <section id="team" class="d-flex flex-wrap justify-content-around">
        <div class="mb-3 card woman" style="width:15rem;">
            <img src="pics/woman.jpg" alt="Rokia" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Rokia</h5>
                <p>20 ans</p>
                <p>Sport, Cinéma</p>
                <a href="#" class="btn btn-danger">Ecrire</a>
            </div>
        </div>

        <?php
        $html = "";
        foreach ($crew as $val) {
            $chpakoi = ($val['sex'] === 'F' ? 'woman' : 'man');
            $html .= '<div class="mb-3 card ' . $chpakoi . '" style="width:15rem;">
            <img src="pics/' . $chpakoi . '.jpg" alt="' . $val['fname'] . '" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">' . $val['fname'] . '</h5>
                <p>' . $val['age'] . ' ans</p>
                <p>' . implode(", ", $val['hobbies']) . '</p>
                <a href="#" class="btn btn-danger">Ecrire</a>
            </div>
        </div>';
        }
        echo $html;
        ?>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>
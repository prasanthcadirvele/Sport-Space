<?php
require_once '../repository/DBManager.php';
require_once 'class/User.php';

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect form data
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresse_mail = $_POST["adresse_mail"];
    $age = $_POST["age"];
    $numero_telephone = $_POST["numero_telephone"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $dbManager = new DBManager();
    $user = new User($nom, $prenom, $adresse_mail, $age, $numero_telephone, $username, $password);
    if(!$dbManager->usernameExists($username)){
        $dbManager->insertUser($user);
        header('Location: login.php');
        exit();
    }else{
        $_SESSION['sign_up_error'] = 'L\'utilisateur avec cet username existe déjà';
        header('Location: signup.php');
        exit();
    }


}

if($_SERVER['REQUEST_METHOD'] === 'GET') {

?>

    <!doctype html>
    <html lang="en">
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="../css/style.css">

    </head>
    <body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(../images/login.gif); background-size: contain; background-position: center center; background-repeat: no-repeat">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Connexion</h3>
                                </div>
                            </div>
                            <form action="signup.php" method="post" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="nom">Nom</label>
                                    <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="prenom">Prénom</label>
                                    <input type="text" class="form-control" placeholder="Prénom" name="prenom" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="adresse_mail">Adresse mail</label>
                                    <input type="text" class="form-control" placeholder="Adresse mail" name="adresse_mail" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="age">Age</label>
                                    <input type="number" class="form-control" placeholder="Age" name="age" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="numero_telephone">Numéro Téléphone</label>
                                    <input type="text" class="form-control" placeholder="Numéro Téléphone" name="numero_telephone" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Username</label>
                                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Mot de passe</label>
                                    <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">S'incrire</button>
                                </div>
                            </form>
                            <p class="text-center">Déjà membre ? <a href="login.php">Connectez-vous</a></p>
                            <?php
                                if (isset($_SESSION['sign_up_error'])) {
                                    echo '<p class="text-danger">'.$_SESSION["sign_up_error"].'</p>';
                                    unset($_SESSION['sign_up_error']);
                                }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>

    </body>
    </html>

<?php
}
?>
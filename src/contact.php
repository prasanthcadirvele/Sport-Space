<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {

}else{

?>

    <!doctype html>
    <html lang="en">
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initia	l-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/contact.css">

    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg" style="background-color: #E3B04B; color: black;">
            <div class="container px-5">
                <a class="navbar-brand" href="index.php">Sport Space</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="center_list.php">Liste des Centres</a></li>
                        <?php
                        if(isset($_SESSION['username']) && isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']){
                            echo '<li class="nav-item"><a class="nav-link" href="mesreservations.php">Mes Réservations</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
                        }else{
                            echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                        }
                        ?>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <h3>Nous Contactez</h3>
                <div class="card">
                    <form class="form-card" action="contact.php" method="post">
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Nom<span class="text-danger"> *</span></label>
                                <input type="text" id="nom" name="nom" placeholder="Nom" required>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Prénom<span class="text-danger"> *</span></label>
                                <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Adresse mail<span class="text-danger"> *</span></label>
                                <input type="text" id="email" name="email" placeholder="Adresse Mail" required>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Téléphone<span class="text-danger"> *</span></label>
                                <input type="text" id="numero_telephone" name="numero_telephone" placeholder="Téléphone" required>
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex">
                                <label class="form-control-label px-3">Votre message<span class="text-danger"> *</span></label>
                                <textarea type="text" id="message" name="message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="form-group col-sm-4"> <button type="submit" class="btn-block" style="background-color: #215294; color: white">Envoyer</button> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php

}

?>
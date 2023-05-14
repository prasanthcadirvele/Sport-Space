<?php


require_once '../repository/DBManager.php';

session_start();

if(!isset($_SESSION['username']) && !$_SESSION['user_logged_in']) {
    header('Location: login.php');
    exit();
}


$dbManager = new DBManager();

$reservations = $dbManager->getAllReservationsByUser($_SESSION['username']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sport Space</title>
    <link href="../css/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/contact.css" rel="stylesheet" />
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

<div class="container">
    <div class="mt-4 row justify-content-center">
        <div class="col-md-8">
            <h2>Mes Réservations</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nom du Centre</th>
                    <th>Adresse</th>
                    <th>Réservation Debut</th>
                    <th>Réservation Fin</th>
                    <th>Prix</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?php echo $reservation->getCourt()->getCenter()->getName(); ?></td>
                        <td><?php echo $reservation->getCourt()->getCenter()->getAddress(); ?></td>
                        <td><?php echo $reservation->getReservationDebut(); ?></td>
                        <td><?php echo $reservation->getReservationFin(); ?></td>
                        <td><?php echo $reservation->getNombreDePersonnes()*$reservation->getCourt()->getPrixUnitaireParHeure(); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


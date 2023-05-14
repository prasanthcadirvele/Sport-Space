<?php

require_once '../repository/DBManager.php';

session_start();

$dbManager = new DBManager();

$centers = $dbManager->getAllCenters();
$centers = array_slice($centers, 0, 3);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Sport Space</title>
        <link href="../css/styles.css" rel="stylesheet" />
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
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="../images/index.jpg" style="max-width: 100%; max-height: 100%" alt="Index Image" /></div>
                <div class="col-lg-5">
                    <h1 class="font-weight-light">Sport Space</h1>
                    <p>Notre entreprise de terrains de sport propose une plateforme conviviale qui permet aux clients de réserver facilement les terrains disponibles pour leurs activités sportives préférées. En quelques clics, nos clients peuvent réserver leur terrain préféré et planifier leurs jeux sans effort.</p>
                    <a class="btn btn-primary" href="center_list.php" style="background-color: #215294">Reserver Maintenant</a>
                </div>

            </div>
            <!-- Call to Action-->
            <div class="card text-white bg-secondary my-5 py-1 text-center">
                <div class="card-body"><p class="text-white m-0">Il est possible de voir la liste des terrains disponibles en fonction du sport et du centre sur notre plateforme conviviale de réservation de terrains de sport.</p></div>
            </div>
            <!-- Content Row-->
            <div class="row gx-4 gx-lg-5">
                <?php

                foreach ($centers as $center){
                    $sports = $dbManager->getAllSportsByCenter($center->getId());
                    ?>
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo $center->getName()?></h2>
                                <p class="card-text">
                                    <?php echo $center->getAddress()?>
                                </p>
                                <ul>
                                    <?php
                                    foreach ($sports as $sport){
                                        echo '<li>'.$sport->getNomSport().'</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="card-footer"><a class="btn btn-sm" style="background-color: #215294; color: white" href="reservation.php?center_id=<?php echo $center->getId()?>">Réserver</a></div>
                        </div>
                    </div>
                    <?php

                }

                ?>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
